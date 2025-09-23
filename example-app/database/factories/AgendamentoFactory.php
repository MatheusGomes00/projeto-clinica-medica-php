<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agendamento>
 */
class AgendamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pendente', 'confirmado', 'cancelado'];
        $horaInicio = Carbon::today()->addHours($this->faker->numberBetween(8, 16));
        $horaFim = (clone $horaInicio)->addMinutes($this->faker->randomElement([30, 60, 90]));
        return [
            'descricao' => fake()->sentence(3),
            'hora_inicio' => $horaInicio,
            'hora_fim' => $horaFim,
            'comentario' => fake()->paragraph(1),
            'paciente_id' => Paciente::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement($status),
        ];
    }
}
