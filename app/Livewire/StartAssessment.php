<?php

namespace App\Livewire;

use App\Models\Assessment;
use Livewire\Component;

class StartAssessment extends Component
{

    public Assessment $assessment;
    public $questions;

    public $activeQuestion = 0;

    public $timeRemaining = 50;

    public $answer = '';

    public $theoryAnswers = [];

    public function mount($assessment)
    {
        $this->assessment = $assessment;
        $this->questions = json_decode($assessment->questions);
    }

    public function nextQuestion()
    {

        $this->theoryAdd('next');
        $this->activeQuestion++;
    }

    public function previousQuestion()
    {
        $this->theoryAdd('prev');
        $this->activeQuestion--;
    }

    public function setActiveQuestion($index)
    {
        $this->activeQuestion = $index;
    }

    public function submitAssessment()
    {
        $answers = [];
        $totalMark = 0;
        if ($this->assessment->type === 'theory') {
            $this->theoryAdd('submit');
            // validate if all questions are answered
            if (count($this->theoryAnswers) !== count($this->questions)) {
                $this->addError('answer', 'Please answer all questions');
                $this->addError('all', 'Please answer all questions');
                return;
            }

            $answers = $this->theoryAnswers;
        }

        // save the answers
        $studentId = auth()->id();

        $this->assessment->students()->attach($studentId, [
            'answers' => json_encode($answers),
            'status' => 'completed',
            // total mark calculation will be null if type is theory
            'total_mark' => $this->assessment->type === 'theory' ? null : $totalMark,
            'completed_at' => now(),
            'submitted' => true,
        ]);

        session()->flash('success', 'Assessment submitted successfully');

        return redirect()->route('assessments');
    }

    public function render()
    {
        return view('livewire.start-assessment');
    }

    /**
     * @return void
     */
    private function theoryAdd($type): void
    {
        if ($this->assessment->type === 'theory') {
            // if answer is not empty
            if ($this->answer) {
                $this->theoryAnswers[$this->activeQuestion] = [
                    'question' => $this->questions[$this->activeQuestion]->question,
                    'answer' => $this->answer,
                ];
                $this->answer = '';
            } else {
                if ($type === 'next') {
                    // check to see if the question is already answered and update the answer
                    if (isset($this->theoryAnswers[$this->activeQuestion + 1])) {
                        $this->answer = $this->theoryAnswers[$this->activeQuestion + 1]['answer'];
                    }
                } else {
                    if ($type === 'prev') {
                        // check to see if the question is already answered and update the answer
                        if (isset($this->theoryAnswers[$this->activeQuestion - 1])) {
                            $this->answer = $this->theoryAnswers[$this->activeQuestion - 1]['answer'];
                        }
                    }
                }
            }
        }
    }
}
