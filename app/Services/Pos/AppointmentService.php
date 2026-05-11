<?php

namespace App\Services\Pos;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Business;
use App\Models\RoomChair;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AppointmentService
{
    public function __construct(private readonly PosReferenceGenerator $referenceGenerator)
    {
    }

    public function schedule(Business $business, array $data): Appointment
    {
        return DB::transaction(function () use ($business, $data): Appointment {
            $branch = $this->resolveBranch($business, $data['branch_id'] ?? null);
            $customer = $business->customers()->whereKey($data['customer_id'])->firstOrFail();
            $service = $business->services()->whereKey($data['service_id'])->firstOrFail();
            $staff = $business->staffMembers()->whereKey($data['staff_id'])->firstOrFail();
            $roomChair = $this->resolveRoomChair($business, $data['room_chair_id'] ?? null);

            $duration = (int) ($data['duration_minutes'] ?? $service->duration_minutes);
            $bookingDate = Carbon::parse($data['booking_date'])->toDateString();
            $start = Carbon::createFromFormat('H:i', $data['start_time']);
            $end = (clone $start)->addMinutes($duration);

            $this->ensureAvailability(
                business: $business,
                bookingDate: $bookingDate,
                startTime: $start->format('H:i:s'),
                endTime: $end->format('H:i:s'),
                staff: $staff,
                roomChair: $roomChair,
            );

            return Appointment::query()->create([
                'business_id' => $business->id,
                'branch_id' => $branch?->id,
                'customer_id' => $customer->id,
                'service_id' => $service->id,
                'staff_id' => $staff->id,
                'room_chair_id' => $roomChair?->id,
                'appointment_number' => $this->referenceGenerator->next(
                    business: $business,
                    prefix: 'BKG',
                    query: Appointment::query()->where('business_id', $business->id),
                    column: 'appointment_number',
                ),
                'booking_date' => $bookingDate,
                'start_time' => $start->format('H:i:s'),
                'end_time' => $end->format('H:i:s'),
                'duration_minutes' => $duration,
                'status' => $data['status'],
                'notes' => $data['notes'] ?? null,
                'reminder_sent' => (bool) ($data['reminder_sent'] ?? false),
                'reminder_sent_at' => ! empty($data['reminder_sent']) ? now() : null,
            ]);
        });
    }

    private function ensureAvailability(
        Business $business,
        string $bookingDate,
        string $startTime,
        string $endTime,
        Staff $staff,
        ?RoomChair $roomChair,
    ): void {
        $baseQuery = Appointment::query()
            ->where('business_id', $business->id)
            ->whereDate('booking_date', $bookingDate)
            ->whereNotIn('status', ['Cancelled', 'No-show'])
            ->where(function ($query) use ($startTime, $endTime) {
                $query
                    ->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            });

        if ((clone $baseQuery)->where('staff_id', $staff->id)->exists()) {
            throw ValidationException::withMessages([
                'start_time' => 'The selected staff member already has an overlapping appointment.',
            ]);
        }

        if ($roomChair && (clone $baseQuery)->where('room_chair_id', $roomChair->id)->exists()) {
            throw ValidationException::withMessages([
                'room_chair_id' => 'The selected room or chair is already booked for that time slot.',
            ]);
        }
    }

    private function resolveBranch(Business $business, mixed $branchId): ?Branch
    {
        if (! $branchId) {
            return $business->primaryBranch()->first();
        }

        return $business->branches()->whereKey($branchId)->firstOrFail();
    }

    private function resolveRoomChair(Business $business, mixed $roomChairId): ?RoomChair
    {
        if (! $roomChairId) {
            return null;
        }

        return RoomChair::query()
            ->where('business_id', $business->id)
            ->whereKey($roomChairId)
            ->firstOrFail();
    }
}
