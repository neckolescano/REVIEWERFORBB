<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earth Science Interactive Exam</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        body { 
            font-family: 'Courier New', Courier, monospace; 
            background: radial-gradient(circle at top, #0f172a, #020617);
            color: #00ff41; 
            margin: 0; 
            padding: 20px; 
        }

        .container { 
            max-width: 750px; 
            margin: 40px auto; 
            background: rgba(15,23,42,0.9); 
            padding: 35px; 
            border: 4px solid #38bdf8; 
            box-shadow: 10px 10px 0px #0ea5e9;
            border-radius: 16px;
            backdrop-filter: blur(10px);
        }

        /* Retro Title */
        .retro-title { 
            font-family: 'Press Start 2P', cursive;
            font-size: 2.8rem; 
            text-align: center; 
            color: #7dd3fc; 
            text-shadow: 3px 3px #0ea5e9, 0 0 15px rgba(125,211,252,0.6);
            margin-bottom: 40px;
            animation: glowPulse 2s infinite alternate;
        }

        .retro-sub {
            text-align: center;
            font-size: 0.8rem;
            color: #f9a8d4;
            margin-top: -20px;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        /* Pixel Buttons */
        .start-btn { 
            display: block; 
            width: 100%; 
            padding: 18px; 
            margin: 15px 0; 
            font-family: 'Press Start 2P', cursive;
            background: linear-gradient(145deg, #7dd3fc, #38bdf8);
            color: #020617; 
            text-align: center; 
            cursor: pointer; 
            font-size: 1.1rem; 
            box-shadow: 0 6px #0369a1;
            transition: all 0.15s ease;
        }

        .start-btn:hover { 
            transform: translateY(-3px);
            box-shadow: 0 10px #0369a1;
        }

        .start-btn:active {
            transform: translateY(3px);
            box-shadow: 0 2px #0369a1;
        }

        /* Floating hearts */
        .heart {
            position: absolute;
            color: #f9a8d4;
            font-size: 12px;
            animation: floatUp 6s linear infinite;
            opacity: 0.7;
        }

        @keyframes glowPulse {
            from { text-shadow: 2px 2px #0ea5e9, 0 0 5px #38bdf8; }
            to { text-shadow: 4px 4px #0ea5e9, 0 0 20px #7dd3fc; }
        }

        @keyframes floatUp {
            from { transform: translateY(0); opacity: 0.7; }
            to { transform: translateY(-600px); opacity: 0; }
        }

        /* === RESULT IMPROVEMENTS === */

        .percentage {
            font-size: 1.4rem;
            font-weight: bold;
            color: #e2e8f0;
            margin-bottom: 20px;
        }

        .result-message {
            font-size: 1.1rem;
            margin-top: 10px;
            font-weight: bold;
            text-align: center;
        }

        .result-perfect { color: #4ade80; }
        .result-good { color: #38bdf8; }
        .result-bad { color: #f87171; }

        .restart-btn {
            display: inline-block;
            padding: 14px 28px;
            background: linear-gradient(135deg, #38bdf8, #f472b6);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            transition: 0.2s;
        }

        .restart-btn:hover {
            transform: scale(1.05);
        }

        /* ASCII container fix */
        .ascii-container {
            margin-top: 25px;
            background: #020617;
            padding: 15px;
            border-radius: 10px;
            overflow-x: auto;
        }

        /* KEEPING YOUR ORIGINAL STYLES BELOW */
        h1 { font-size: 1.8rem; text-align: center; color: #38bdf8; margin-bottom: 5px; }
        .subtitle { text-align: center; color: #94a3b8; font-size: 0.95rem; margin-bottom: 25px; }
        .progress-container { background: #334155; height: 10px; border-radius: 6px; margin-bottom: 30px; overflow: hidden; }
        .progress-bar { background: linear-gradient(90deg, #38bdf8, #0ea5e9); height: 100%; transition: width 0.3s ease; }
        .status-text { font-size: 0.9rem; color: #94a3b8; font-weight: bold; text-align: right; margin-bottom: 15px; }
        .question-card { animation: fadeIn 0.4s ease; }
        .question-text { font-size: 1.25rem; font-weight: 600; color: #f8fafc; line-height: 1.6; margin-bottom: 25px; }
        .options-group { display: flex; flex-direction: column; gap: 14px; margin-bottom: 25px; }
        .option-label { display: flex; align-items: center; padding: 16px 20px; background: #1e293b; border: 2px solid #475569; border-radius: 10px; cursor: pointer; transition: all 0.2s ease; font-weight: 500; color: #cbd5e1; }
        .option-label:hover { background: #334155; border-color: #64748b; color: #fff; }
        .option-label input { margin-right: 14px; transform: scale(1.3); cursor: pointer; accent-color: #38bdf8; }
        .option-label.selected { border-color: #38bdf8; background: #0c4a6e; color: #f0f9ff; }
        .option-label.correct-reveal { border-color: #4ade80 !important; background: #064e3b !important; color: #ecfdf5; font-weight: bold; }
        .option-label.wrong-reveal { border-color: #f87171 !important; background: #7f1d1d !important; color: #fef2f2; }
        .feedback-banner { padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; font-weight: bold; animation: slideDown 0.3s ease; }
        .feedback-banner.success { background: #064e3b; color: #4ade80; border-left: 5px solid #4ade80; }
        .feedback-banner.error { background: #7f1d1d; color: #f87171; border-left: 5px solid #f87171; }
        .nav-controls { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 15px; margin-top: 35px; border-top: 1px solid #334155; padding-top: 25px; }
        .btn { padding: 14px 24px; border: none; font-size: 1rem; font-weight: bold; border-radius: 8px; cursor: pointer; transition: all 0.2s ease; }
        .btn-secondary { background: #334155; color: #cbd5e1; }
        .btn-warning { background: #b45309; color: white; }
        .btn-primary { background: #0ea5e9; color: white; flex-grow: 1; }
        .btn-success { background: #22c55e; color: white; }
        .results-summary { text-align: center; }
        .score-circle { width: 160px; height: 160px; border-radius: 50%; background: #064e3b; border: 5px solid #4ade80; display: flex; justify-content: center; align-items: center; margin: 30px auto; }
        .score-num { font-size: 2.5rem; font-weight: bold; color: #4ade80; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-12px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>

<body>

<div class="container" x-data="quizApp()">

    <!-- START SCREEN -->
<template x-if="gameState === 'start'">
    <div style="position: relative; overflow: hidden; min-height: 400px;">
        
        <template x-for="i in 20">
            <div class="heart"
                 :style="`left:${Math.random()*100}%; animation-delay:${Math.random()*5}s;`">♥</div>
        </template>

        <h1 class="retro-title">EARTH SCIENCE QUEST</h1>
        <div class="retro-sub">A cute little quiz for you babyyy mwaa 💖</div>

        <div class="start-btn" @click="playClick(); gameState='playing'">
            ▶ PRESS START
        </div>

        <div class="start-btn" style="opacity:0.6;">⚙ OPTIONS</div>
        <div class="start-btn" style="opacity:0.4;">❌ QUIT</div>
    </div>
</template>

<!-- ✅ QUIZ (HIDDEN UNTIL START) -->
<form x-show="gameState === 'playing'"
      @submit.prevent="submitExam"
      action="{{ route('quiz.submit') }}"
      method="POST"
      id="mainQuizForm">

    @csrf

    <div x-init="
        @foreach($questions as $id => $data)
            questions.push({
                id: {{ $id }},
                q: `{{ $data['q'] }}`,
                correct: '{{ $data['correct'] }}',
                options: {
                    @foreach($data['options'] as $letter => $text)
                        @if(!empty($text)) '{{ $letter }}': `{{ $text }}`, @endif
                    @endforeach
                },
                selectedAnswer: null,
                checked: false
            });
        @endforeach
        totalQuestions = questions.length;
    "></div>

    <template x-if="!quizFinished && totalQuestions > 0">
        <div class="question-card">
            <div class="question-text">
                <span x-text="questions[currentIndex].id + '. ' + questions[currentIndex].q"></span>
            </div>

            <div class="options-group">
                <template x-for="(text, letter) in questions[currentIndex].options">
                    <label class="option-label" :class="{
                        'selected': questions[currentIndex].selectedAnswer === letter,
                        'correct-reveal': questions[currentIndex].checked && letter === questions[currentIndex].correct,
                        'wrong-reveal': questions[currentIndex].checked && questions[currentIndex].selectedAnswer === letter && letter !== questions[currentIndex].correct
                    }">
                        <input type="radio" 
                               :name="'answers[' + questions[currentIndex].id + ']'" 
                               :value="letter"
                               x-model="questions[currentIndex].selectedAnswer"
                               :disabled="questions[currentIndex].checked">
                        <span x-text="letter + '. ' + text"></span>
                    </label>
                </template>
            </div>

            <template x-if="questions[currentIndex].checked">
                <div class="feedback-banner" :class="questions[currentIndex].selectedAnswer === questions[currentIndex].correct ? 'success' : 'error'">
                    <template x-if="questions[currentIndex].selectedAnswer === questions[currentIndex].correct">
                        <span>✓ Correct! Fantastic job.</span>
                    </template>
                    <template x-if="questions[currentIndex].selectedAnswer !== questions[currentIndex].correct">
                        <span>✗ Incorrect. The correct answer is option <span x-text="questions[currentIndex].correct"></span>.</span>
                    </template>
                </div>
            </template>

            <div class="nav-controls">
                <div>
                    <button type="button" class="btn btn-secondary" 
                            @click="prevQuestion()" 
                            :disabled="currentIndex === 0">
                        Back
                    </button>

                    <button type="button" class="btn btn-warning" 
                            @click="resetToFirst()" 
                            :disabled="currentIndex === 0">
                        Go to #1
                    </button>
                </div>

                <div style="display: flex; gap: 15px; flex-grow: 1; justify-content: flex-end;">
                    <button type="button" class="btn btn-success" 
                            @click="checkCurrentAnswer()" 
                            x-show="questions[currentIndex].selectedAnswer && !questions[currentIndex].checked">
                        Check Answer
                    </button>

                    <button type="button" class="btn btn-primary" 
                            @click="nextQuestion()" 
                            x-show="currentIndex < totalQuestions - 1"
                            :disabled="!questions[currentIndex].selectedAnswer">
                        Next
                    </button>

                    <button type="button" class="btn btn-primary" 
                            @click="finishQuiz()" 
                            x-show="hasAnyAnswer()"
                            style="background: linear-gradient(135deg, #0ea5e9, #f43f5e);">
                        Finish Exam
                    </button>
                </div>
            </div>
        </div>
    </template>

    <!-- RESULTS -->
    <template x-if="quizFinished">
        <div class="results-summary">
            <h1>Performance Summary</h1>

            <div class="score-circle">
                <div class="score-num">
                    <span x-text="finalScore"></span> /
                    <span x-text="totalQuestions"></span>
                </div>
            </div>

            <div class="percentage">
                Final Grade:
                <span x-text="Math.round((finalScore / totalQuestions) * 100)"></span>%
            </div>

            <!-- 🔥 NEW RESULT MESSAGE -->
            <div class="result-message"
                 :class="{
                    'result-perfect': (finalScore / totalQuestions) >= 0.8,
                    'result-good': (finalScore / totalQuestions) >= 0.5 && (finalScore / totalQuestions) < 0.8,
                    'result-bad': (finalScore / totalQuestions) < 0.5
                 }">

                <template x-if="(finalScore / totalQuestions) >= 0.8">
                    <span>🌟 WoW! Very Good Mwaaaa!</span>
                </template>

                <template x-if="(finalScore / totalQuestions) >= 0.5 && (finalScore / totalQuestions) < 0.8">
                    <span>👍 Good job! Keep improving!</span>
                </template>

                <template x-if="(finalScore / totalQuestions) < 0.5">
                    <span>💔 Don't worry, try again!</span>
                </template>
                

            </div>

            <div style="margin-top: 30px;">
                <a href="{{ route('quiz.index') }}" class="restart-btn">
                    Retake Examination
                </a>
            </div>
        </div>
    </template>

</form>
</div>
</div>

<script>
function quizApp() {
    return {
        gameState: 'start',
        currentIndex: 0,
        totalQuestions: 0,
        questions: [],
        quizFinished: false,
        finalScore: 0,

        playClick() {
            const audio = new Audio('https://assets.mixkit.co/sfx/preview/mixkit-select-click-1109.mp3');
            audio.volume = 0.3;
            audio.play();
        },

        nextQuestion() { if (this.currentIndex < this.totalQuestions - 1) this.currentIndex++; },
        prevQuestion() { if (this.currentIndex > 0) this.currentIndex--; },
        resetToFirst() { this.currentIndex = 0; },
        hasAnyAnswer() { return this.questions.some(q => q.selectedAnswer !== null); },
        checkCurrentAnswer() { this.questions[this.currentIndex].checked = true; },
        finishQuiz() {
            let score = 0;
            this.questions.forEach(q => { if (q.selectedAnswer === q.correct) score++; });
            this.finalScore = score;
            this.quizFinished = true;
        }
    }
}
</script>

</body>
</html>