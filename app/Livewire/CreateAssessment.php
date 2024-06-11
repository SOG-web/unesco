<?php

namespace App\Livewire;

use Livewire\Component;

class CreateAssessment extends Component
{
    public string $selectedCourse = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $type = '';
    public string $mark_per_question = '';
    public string $show_result = '';

    public $add_question = true;

    public $questions = [];

    public $theory_question = '';

    public $multi_choice_question = '';

    public $option_a = '';

    public $option_b = '';

    public $option_c = '';

    public $option_d = '';

    public $correct_option = '';

    public $currentStep = 1;

    public $types = [
        ['name' => 'Theory', 'label' => 'theory', 'id' => 'theory'],
        ['name' => 'Multiple-choice', 'label' => 'multiple-choice', 'id' => 'multiple-choice'],
    ];

    public $show_results = [
        ['name' => 'yes', 'label' => 'Yes', 'id' => 'yes'],
        ['name' => 'no', 'label' => 'No', 'id' => 'no'],
    ];

    public $correct_options = [];

    public $number_of_question_allowed = 1;

    public function setCorrectOption()
    {
        $this->correct_options = [
            ['name' => $this->option_a, 'label' => $this->option_a, 'id' => $this->option_a],
            ['name' => $this->option_b, 'label' => $this->option_b, 'id' => $this->option_c],
            ['name' => $this->option_c, 'label' => $this->option_c, 'id' => $this->option_c],
            ['name' => $this->option_d, 'label' => $this->option_d, 'id' => $this->option_d],
        ];
    }


    public function addQuestion()
    {
        if ($this->type === 'theory') {
            $this->validate([
                'theory_question' => 'required|string',
            ]);

            $this->questions[] = [
                'question' => $this->theory_question,
            ];
            $this->add_question = false;
            $this->theory_question = '';
        } else {
            $this->validate([
                'multi_choice_question' => 'required|string',
                'option_a' => 'required|string',
                'option_b' => 'required|string',
                'option_c' => 'required|string',
                'option_d' => 'required|string',
                'correct_option' => 'required|string',
            ]);

            $this->questions[] = [
                'question' => $this->multi_choice_question,
                'options' => [
                    'option_a' => $this->option_a,
                    'option_b' => $this->option_b,
                    'option_c' => $this->option_c,
                    'option_d' => $this->option_d,
                ],
                'answer' => $this->correct_option,
            ];

            $this->add_question = false;
            $this->multi_choice_question = '';
            $this->option_a = '';
            $this->option_b = '';
            $this->option_c = '';
            $this->option_d = '';
            $this > $this->correct_option = '';
        }
    }

    public function saveStepOne(): void
    {
        $this->validate([
            'selectedCourse' => 'required|string',
            'start_date' => 'required|string|date',
            'end_date' => 'required|string|date',
            'type' => 'required|string',
            'mark_per_question' => 'string|nullable',
            'show_result' => 'required|string',
        ]);

        if ($this->mark_per_question) {
            //1. convert to number
            $mark_per_question = (int) $this->mark_per_question;

            //2. calculate to 100
            $total_marks = 100;

            //3. set allowed question
            $this->number_of_question_allowed = $total_marks / $mark_per_question;
        }

        $this->currentStep = 2;
    }

    public function createAssessment(): void
    {
        dd('create assessment', $this->questions);
    }

    public function render()
    {
        $cour = auth()->user()->courses()->get();
        // foreach ($cour as $key => $value) {}

        $courses = $cour->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->title,
                'label' => $course->title,
            ];
        });
        return view('livewire.create-assessment', [
            'courses' => $courses,
        ]);
    }
}
