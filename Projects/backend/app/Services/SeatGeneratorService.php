<?php

namespace App\Services;

use App\Models\Voucher;

class SeatGeneratorService
{
    public function generateSeat(string $aircraftType): array
    {
        // Generate seats based on aircraft type
        $allSeats = $this->getAllSeats($aircraftType);
        return $allSeats;
    }

    private function getAllSeats(string $aircraftType): array
    {
        // Define seat configurations for different aircraft types
        switch ($aircraftType) {
            case 'ATR':
                $permittedCharacters = ['A', 'C', 'D', 'F'];
                $GeneratedSeats = [];
                while (count($GeneratedSeats) < 3) {
                    $row = rand(1, 18);
                    $seat = $permittedCharacters[array_rand($permittedCharacters)];
                    $newSeat = $row . $seat;
                    if (!in_array($newSeat, $GeneratedSeats)) {
                        $GeneratedSeats[] = $newSeat;
                    }
                }
                return $GeneratedSeats;
            case 'Airbus 320':
                $permittedCharacters = ['A', 'B', 'C', 'D','E', 'F'];
                $GeneratedSeats = [];
                while (count($GeneratedSeats) < 3) {
                    $row = rand(1, 32);
                    $seat = $permittedCharacters[array_rand($permittedCharacters)];
                    $newSeat = $row . $seat;
                    if (!in_array($newSeat, $GeneratedSeats)) {
                        $GeneratedSeats[] = $newSeat;
                    }
                }
                return $GeneratedSeats;
            case 'Boeing 737 Max':
                $permittedCharacters = ['A', 'B', 'C', 'D', 'E', 'F'];
                $GeneratedSeats = [];
                while (count($GeneratedSeats) < 3) {
                    $row = rand(1, 32);
                    $seat = $permittedCharacters[array_rand($permittedCharacters)];
                    $newSeat = $row . $seat;
                    if (!in_array($newSeat, $GeneratedSeats)) {
                        $GeneratedSeats[] = $newSeat;
                    }
                }
                return $GeneratedSeats;
            default:
                throw new \Exception('Unknown aircraft type.');
        }
    }
}

