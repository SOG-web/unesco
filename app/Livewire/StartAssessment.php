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

    public $multiChoiceAnswers = [];

    public $completed = false;

    public $finalMark = 0;

    public function mount($assessment): void
    {
        $this->assessment = $assessment;
        $this->questions = json_decode($assessment->questions);
    }


    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    public function nextQuestion(): void
    {

        $this->add('next');

        $this->activeQuestion++;
    }

    public function previousQuestion(): void
    {
        $this->add('prev');
        $this->activeQuestion--;
    }

    public function setActiveQuestion($index): void
    {
        $this->activeQuestion = $index;
    }

    public function submitAssessment(): void
    {
        $answers = [];
        $totalMark = 0;
        $this->add('submit');
        if ($this->assessment->type === 'theory') {
            // validate if all questions are answered
            if (count($this->theoryAnswers) !== count($this->questions)) {
                $this->addError('answer', 'Please answer all questions');
                $this->addError('all', 'Please answer all questions');
                return;
            }

            $answers = $this->theoryAnswers;
        } else {
            // validate if all questions are answered
            if (count($this->multiChoiceAnswers) !== count($this->questions)) {
                $this->addError('answer', 'Please answer all questions');
                $this->addError('all', 'Please answer all questions');
                return;
            }

            foreach ($this->multiChoiceAnswers as $index => $answer) {
                $question = $this->questions[$index];
                $correctAnswer = $question->answer;
                if ($answer['answer'] === $correctAnswer) {
                    $totalMark += $this->assessment->mark_per_questions;
                }
            }

            $answers = $this->multiChoiceAnswers;
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

        // progress of the course will be updated to 100 here
        $progress = auth()->user()->progress()->where('course_id', $this->assessment->course_id)->first();

        // update the progress of the course
        $progress->update([
            'progress' => 100.00,
            'completed' => true,
        ]);

        // save activity
        auth()->user()->activities()->create([
            'title' => 'Assessment submitted',
            'content' => 'Assessment submitted '.$this->assessment->title,
            'status' => 'unread',
            'type' => 'other',
        ]);


        $this->finalMark = $totalMark;
        $this->completed = true;

    }

    public function render()
    {
        return view('livewire.start-assessment');
    }

    /**
     * @return void
     */
    private function add($type): void
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
        } else {
            // if answer is not empty
            if ($this->answer) {
                $this->multiChoiceAnswers[$this->activeQuestion] = [
                    'question' => $this->questions[$this->activeQuestion]->question,
                    'answer' => $this->answer,
                ];
                $this->answer = '';
            } else {
                if ($type === 'next') {
                    // dd($this->multiChoiceAnswers, $this->activeQuestion, $this->answer);
                    // check to see if the question is already answered and update the answer
                    if (isset($this->multiChoiceAnswers[$this->activeQuestion + 1])) {
                        $this->answer = $this->multiChoiceAnswers[$this->activeQuestion + 1]['answer'];
                    }
                } else {
                    if ($type === 'prev') {
                        // dd($this->multiChoiceAnswers, $this->activeQuestion, $this->answer);
                        // check to see if the question is already answered and update the answer
                        if (isset($this->multiChoiceAnswers[$this->activeQuestion - 1])) {
                            $this->answer = $this->multiChoiceAnswers[$this->activeQuestion - 1]['answer'];
                        }
                    }
                }
            }
        }
    }
}
