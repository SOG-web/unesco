<?php

namespace App\Livewire;

use App\Models\Assessment;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CreateAssessment extends Component
{
    public string $selectedCourse = '';
    public string $start_date = '';
    public string $end_date = '';
    public string $type = '';
    public string $mark_per_question = '';
    public string $show_result = '';
    public string $title = '';

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

    public $total_questions = 0;

    public $types = [
        ['name' => 'Theory', 'label' => 'Theory', 'id' => 'theory'],
        ['name' => 'Multiple-choice', 'label' => 'Multiple-choice', 'id' => 'multiple-choice'],
    ];

    public $show_results = [
        ['name' => 'Yes', 'label' => 'Yes', 'id' => 'yes'],
        ['name' => 'No', 'label' => 'No', 'id' => 'no'],
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
            $this->total_questions = 1;
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

            $this->total_questions = $this->total_questions + 1;
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
            'title' => 'required|string',
        ]);

        if ($this->mark_per_question) {
            //1. convert to number
            $mark_per_question = (int) $this->mark_per_question;

            //2. calculate to 100
            $total_marks = 100;

            //3. set allowed question
            $this->number_of_question_allowed = $total_marks / $mark_per_question;
        } else {
            $this->number_of_question_allowed = 1;
        }
        $this->total_questions = $this->total_questions + 1;

        $this->currentStep = 2;
    }

    #[Computed]
    public function getIsButtonDisabledProperty(): bool
    {
        if ($this->type === 'theory') {
            return true;
        } else {
            return count($this->questions) === $this->number_of_question_allowed;
        }
    }

    #[Computed]
    public function getIsButtonDisabledProperty2(): bool
    {
        return count($this->questions) !== $this->number_of_question_allowed;
    }

    #[Computed]
    public function getHeadingTextProperty(): string
    {
        return $this->currentStep === 1 ? 'Add New Assessment' : 'Add Question '.$this->total_questions.' of '.$this->number_of_question_allowed;
    }

    #[Computed]
    public function getIsCreateAssessmentButtonProperty(): bool
    {
        return count($this->questions) > 0;
    }

    #[Computed]
    public function getIsShowMulti(): bool
    {
        return $this->type === 'multiple-choice';
    }

    public function createAssessment()
    {
//        dd('create assessment', [
//            'course' => $this->selectedCourse,
//            'start_date' => $this->start_date,
//            'end_date' => $this->end_date,
//            'type' => $this->type,
//            'mark_per_question' => $this->mark_per_question,
//            'show_result' => $this->show_result,
//            'questions' => $this->questions,
//        ]);

        // Validate the data
        $this->validate([
            'title' => 'required|string',
            'selectedCourse' => 'required|string',
            'start_date' => 'required|string|date',
            'end_date' => 'required|string|date',
            'type' => 'required|string',
            'mark_per_question' => 'string|nullable',
            'show_result' => 'required|string',
            'questions' => 'required|array',
        ]);

        // Create a new instance of the Assessment model
        $assessment = new Assessment;

        // Set the properties of the assessment
        $assessment->course_id = $this->selectedCourse;
        $assessment->title = $this->title;
        $assessment->start_date = $this->start_date;
        $assessment->end_date = $this->end_date;
        $assessment->type = $this->type;
        $assessment->show_result = !($this->type === 'theory');
        $assessment->no_of_questions = count($this->questions);
        $assessment->mark_per_questions = (int) $this->mark_per_question;
        $assessment->questions = json_encode($this->questions);

        // Save the assessment to the database
        $assessment->save();

        // save activity
        auth()->user()->activities()->create([
            'title' => 'Assessment created',
            'content' => 'Assessment created for '.$assessment->course->title,
            'status' => 'unread',
            'type' => 'assessment',
        ]);

        // send notification to admin
        $admin = User::where('role', 'admin')->first();

        $admin->setNotification('A new assessment has been created for '.$assessment->course->title.' by '.auth()->user()->first_name.' '.auth()->user()->last_name,
            'assessment', 'New Assessment Created');

        // Reset the properties of the Livewire component
        $this->reset();

        // Redirect the user to the assessments page
        return redirect()->route('assessments');
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
