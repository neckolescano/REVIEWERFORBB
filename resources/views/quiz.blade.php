<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earth Science Interactive Exam</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Modern Dark Theme Variables */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #0f172a; /* Slate 900 */
            color: #f1f5f9; /* Slate 100 */
            margin: 0; 
            padding: 20px; 
        }
        .container { 
            max-width: 750px; /* Slightly widened to support the full art beautifully */
            margin: 40px auto; 
            background: #1e293b; /* Slate 800 */
            padding: 35px; 
            border-radius: 16px; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); 
            border: 1px solid #334155; /* Slate 700 */
        }
        h1 { 
            font-size: 1.8rem; 
            text-align: center; 
            color: #38bdf8; /* Sky 400 */
            margin-bottom: 5px; 
        }
        .subtitle { 
            text-align: center; 
            color: #94a3b8; /* Slate 400 */
            font-size: 0.95rem; 
            margin-bottom: 25px; 
        }
        
        /* Progress Tracking */
        .progress-container { 
            background: #334155; 
            height: 10px; 
            border-radius: 6px; 
            margin-bottom: 30px; 
            overflow: hidden; 
        }
        .progress-bar { 
            background: linear-gradient(90deg, #38bdf8, #0ea5e9); 
            height: 100%; 
            transition: width 0.3s ease; 
        }
        .status-text { 
            font-size: 0.9rem; 
            color: #94a3b8; 
            font-weight: bold; 
            text-align: right; 
            margin-bottom: 15px; 
        }
        
        /* Question Cards */
        .question-card { 
            animation: fadeIn 0.4s ease; 
        }
        .question-text { 
            font-size: 1.25rem; 
            font-weight: 600; 
            color: #f8fafc; 
            line-height: 1.6; 
            margin-bottom: 25px; 
        }
        
        /* Options Style */
        .options-group { 
            display: flex; 
            flex-direction: column; 
            gap: 14px; 
            margin-bottom: 25px; 
        }
        .option-label { 
            display: flex; 
            align-items: center; 
            padding: 16px 20px; 
            background: #1e293b; 
            border: 2px solid #475569; /* Slate 600 */
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.2s ease; 
            font-weight: 500; 
            color: #cbd5e1;
        }
        .option-label:hover { 
            background: #334155; 
            border-color: #64748b; 
            color: #fff;
        }
        .option-label input { 
            margin-right: 14px; 
            transform: scale(1.3); 
            cursor: pointer; 
            accent-color: #38bdf8;
        }
        
        /* Interactive States */
        .option-label.selected { 
            border-color: #38bdf8; 
            background: #0c4a6e; /* Sky 900 */
            color: #f0f9ff;
        }
        .option-label.correct-reveal { 
            border-color: #4ade80 !important; /* Green 400 */
            background: #064e3b !important; /* Green 900 */
            color: #ecfdf5; 
            font-weight: bold; 
        }
        .option-label.wrong-reveal { 
            border-color: #f87171 !important; /* Red 400 */
            background: #7f1d1d !important; /* Red 900 */
            color: #fef2f2; 
        }
        
        /* Explanatory Banner */
        .feedback-banner { 
            padding: 14px 20px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            font-weight: bold; 
            animation: slideDown 0.3s ease; 
        }
        .feedback-banner.success { 
            background: #064e3b; 
            color: #4ade80; 
            border-left: 5px solid #4ade80; 
        }
        .feedback-banner.error { 
            background: #7f1d1d; 
            color: #f87171; 
            border-left: 5px solid #f87171; 
        }

        /* Navigation Controls Dock */
        .nav-controls { 
            display: flex; 
            flex-wrap: wrap;
            justify-content: space-between; 
            gap: 15px; 
            margin-top: 35px; 
            border-top: 1px solid #334155; 
            padding-top: 25px; 
        }
        .btn { 
            padding: 14px 24px; 
            border: none; 
            font-size: 1rem; 
            font-weight: bold; 
            border-radius: 8px; 
            cursor: pointer; 
            transition: all 0.2s ease; 
        }
        .btn-secondary { 
            background: #334155; 
            color: #cbd5e1; 
        }
        .btn-secondary:hover { 
            background: #475569; 
            color: #fff;
        }
        .btn-secondary:disabled { 
            opacity: 0.2; 
            cursor: not-allowed; 
        }
        .btn-warning {
            background: #b45309; /* Amber 700 */
            color: white;
        }
        .btn-warning:hover {
            background: #d97706; /* Amber 600 */
        }
        .btn-primary { 
            background: #0ea5e9; 
            color: white; 
            flex-grow: 1; 
        }
        .btn-primary:hover { 
            background: #38bdf8; 
        }
        .btn-success { 
            background: #22c55e; 
            color: white; 
        }
        .btn-success:hover { 
            background: #4ade80; 
        }
        
        /* Summary Grid */
        .results-summary { 
            text-align: center; 
        }
        .score-circle { 
            width: 160px; 
            height: 160px; 
            border-radius: 50%; 
            background: #064e3b; 
            border: 5px solid #4ade80; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            margin: 30px auto; 
            box-shadow: 0 0 20px rgba(74, 222, 128, 0.2);
        }
        .score-num { 
            font-size: 2.5rem; 
            font-weight: bold; 
            color: #4ade80; 
        }
        .percentage { 
            font-size: 1.4rem; 
            font-weight: 600; 
            color: #e2e8f0; 
            margin-bottom: 30px; 
        }
        .restart-btn { 
            display: inline-block; 
            padding: 16px 36px; 
            background: #0ea5e9; 
            color: white; 
            text-decoration: none; 
            font-weight: bold; 
            border-radius: 8px; 
            transition: background 0.2s; 
        }
        .restart-btn:hover { 
            background: #38bdf8; 
        }

        /* Surprise ASCII Art Styles */
        .ascii-container {
            margin: 30px auto;
            padding: 15px;
            background: #090d16;
            border: 1px dashed #f43f5e;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 0 25px rgba(244, 63, 94, 0.15);
            animation: fadeIn 0.8s ease-out;
        }
        .ascii-art {
            font-family: 'Courier New', Courier, monospace;
            font-size: 5px; /* Tiny font size makes sure the complex art maps cleanly without wrapping rows */
            line-height: 4px;
            letter-spacing: 0px;
            color: #f43f5e;
            text-shadow: 0 0 4px rgba(244, 63, 94, 0.6);
            white-space: pre;
            display: inline-block;
            text-align: left;
        }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-12px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

<div class="container" x-data="quizApp()">
    
    <template x-if="!quizFinished">
        <div>
            <div style="text-align: center; margin-bottom: 25px; padding: 20px; background: rgba(56, 189, 248, 0.05); border: 1px dashed #38bdf8; border-radius: 12px;">
                <span style="font-size: 0.85rem; font-weight: 800; letter-spacing: 2px; color: #f43f5e; text-transform: uppercase; display: block; margin-bottom: 5px; text-shadow: 0 0 8px rgba(244, 63, 94, 0.3);">REVIEWER NI SYA FOR YOU </span>
                <h2 style="font-size: 2.2rem; margin: 0; font-weight: 800; background: linear-gradient(to right, #f43f5e, #38bdf8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; text-shadow: 0px 0px 20px rgba(56, 189, 248, 0.15);">
                    Good Luck Baby!!! 🤍
                </h2>
                <p style="margin: 8px 0 0 0; color: #94a3b8; font-size: 0.95rem; font-style: italic;">
                    "I know na daghan kag gina study hoping maka help ni para anytime ma practice kag answer, I'm always cheering for you mwaa."
                </p>
            </div>

            <h1>Earth Science Practice Examination</h1>
            <div class="subtitle">Interactive Study Assessment</div>
            
            <div class="status-text">Question <span x-text="currentIndex + 1"></span> of <span x-text="totalQuestions"></span></div>
            <div class="progress-container">
                <div class="progress-bar" :style="'width: ' + ((currentIndex + 1) / totalQuestions * 100) + '%'"></div>
            </div>
        </div>
    </template>

    <form @submit.prevent="submitExam" action="{{ route('quiz.submit') }}" method="POST" id="mainQuizForm">
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
                                :disabled="currentIndex === 0"
                                title="Go back to question #1">
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

        <template x-if="quizFinished">
            <div class="results-summary">
                <h1>Performance Summary</h1>
                <p class="subtitle">Your final metrics are computed below:</p>

                <div class="score-circle">
                    <div class="score-num"><span x-text="finalScore"></span> / <span x-text="totalQuestions"></span></div>
                </div>

                <div class="percentage">Final Grade: <span x-text="Math.round((finalScore / totalQuestions) * 100)"></span>%</div>

                <div class="ascii-container">
                    <div style="color: #cbd5e1; font-size: 0.9rem; font-weight: bold; margin-bottom: 10px; font-style: italic;">
                        Surprise! Super proud of you babyyy! 🤍✨
                    </div>
                    <pre class="ascii-art">:::::::::::::::::::::::::::::::::::::::::::---===+*##############%%%%%%%%%#+=---::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::---===+*####%%%%%%%%######%%%%%%%%%#+---::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::--===+*##%%%%%%%%%%%%%%%%%%%%%%%%%%%%*=--:--:::::::::::::
::::::::::::::::::::::::::::::::::::::::-----==+*##%%%%%%%%%#######%%%%%%%%%%%%%%%*=-:::::::::::::::
::::::::::::::::::::::::::::::::::::::::-=+**###%%%%%%%%%%%%###%%%%%%%%%%%%%%%%%%%%*--:::::::::::::
::::::::::::::::::::::::::::::::::::::::--+*###%%%####%%%%%########%%%%%%%%%%%%%%%%%%#+--:::::::::::
:::::::::::::::::::::::::::::::::::::::--=*####%%#####################%%%%%%%%%%%%%%%%%*=-::::::::::
::::::::::::::::::::::::::::::::::::::---*#####%%#**###*******++++++++***##%%%%%%%%%%%%%%=-:::::::::
:::::::::::::::::::::::::::::::::::::---+*####%%#*****++++++==============++*#%%%%%%%%%%%#+-::::::::
:::::::::::::::::::::::::::::::::::::-=+*########**+=======-------------=====+##%%%%%%%%%%#=-:::::::
:::::::::::::::::::::::::::::::::::::-=*########*+====---------------------===+*#%%%%%%%%%%*----:::-
::::::::::::::::::::::::::::::::::::-=+*#######*+===-------------------------===++*#%%%%%%%%+-------
::::::::::::::::::::::::::::::::::::-+*##%%#%#*+==-------------:::------------====++*%%%%%%%%*------
::::::::::::::::::::::::::::::::::::=*##%%%%%*+===--------------::::::---------======*#%%%%%%%#-----
::::::::::::::::::::::::::::::::::::=*#%%%%%#*+==---------------:::::::--=====------==+###*#%%%+----
::::::::::::::::::::::::::::::::::::=*#%%%%%#+==-----------------::::-====-----------==+*#**+#%%=---
::::::::::::::::::::::::::::::::::::-*#%%%%%#+===-------------------=+++=---=====------=+**+=#%#+---
::::::::::::::::::::::::::::::::::::-+#%%%%%#++===----------------=++++===+***+=-------==++=+#%#+---
::::::::::::::::::::::::::::::::::::-+#%%%%%#*+===--------------==+++++*#***------------=++=+%%#+---
::::::::::::::::::::::::::::::::::::-=+%%%%%%*+===-------------==+++++*+#%#=-=----------==+==#%#=---
::::::::::::::::::::::::::::::::::::--=*%%%%%%*====------=====--===++**+===++=-::::-----====**%#=---
::::::::::::::::::::::::::::::::::::--=+%%%%%%%*===--===+++++==-----===+++=---:::::-----===+#%%#=---
:::::::::::::::::::::::::::::::::::::--=*%%%%%%%+=++*********+==-----------:::::::-------==+#@@#=---
:::::::::::::::::::::::::::::::::::::---=#%%%@@@%**++++++**++++=--::::::--:::::::---------==*%%%+=--
:::::::::::::::::::::::::::::::::::::----+#%%@@@@%++****%%#+====---:::--==-----------------=+#%%*=--
::::::::::::::::::::::::::::::::::::::---=+#%%@@@@%*##++++++===-=--:::----====-------------==*%##=--
::::::::::::::::::::::::::::::::::::------=+%%@@@@@#++++++=----==--:::::---=--------------===+#%#=-=
:::::::::::::::::::::::::::::::::::--------=+%%%%%%%*+==------====--:---==+-::------------==+=+%*=--
::::::::::::::::--::::::::::::::::--------=*###%%%%%%#+==-----===========---:---=====---===++==*+---
:::::::::::::::-==::::::::::::::----------+*####%%%%%%%#+======++**#*++=------==+===---===+++===++++
::::-=+=::::::-==:::::::::::::-----========**####%%%%%%%%*++====++++==-=====+++=-----===++++===+#%%%
:::==-:::::--==-::::::::::::--=+*#####%%%##*#%%%%%%%%@%%%%#####****+++++++++==-----====++++==+#%%%%%
:::::::::-=+=----:::::::::-=+*########%%%%%%%%%%%@@%%@@%%%%%%%%%%%%%###*+===-----=====+++*+*#%%%%%%%
:::::::-+=------==--------=+############%%%%@@@%@@%%%%%%%%%%%%%%%%%%%%%#+============+++*%%%%%%%%%%%
:----=+=---======--=----=+*##%#%%%%%%%%%%%%%%@@@%%%%%%%%%%%%%%#%%%%%%%%%%#*+=========+*#%%%%%%%%%%@%
:--------===+=++=-==---=+##%%%%%%%###%%%%@@@%%@%%@%%%%%%%%%##%%%%%%%%%%%%%%*+++=+++++#%@%%%%%%%%%%%%
::--------==++=+===-===+#%%%%%%%%%%%%%%%%%%%%####%%%%%%%%%%%%%%%%%%%%@@@%%@%##****#%@@@%%%%%%@@%%%%%
------::-:---=======++=#%%%%%%%%%%@@@%#*+++=====++*##%%%%%%%%%#%%%%%@@@@@@@@%%%%@@@@@@@@%%@@@@%%%%%%
--=-----:::------==++=*%%%%%%%%%@@%#*+===---------===+**###%%%%%%%%%%@@@@@@@@@@@@@@@@@@@%@@@%%%%%%%%
----=+==------------=*%%%%%%%%@@%#+====--------------====+**##%%%%%%@@@@@@@@@@@@@@@@@@@@@@@%%%%%%%%%
-------======-----:::-=*%%%%%%%%*+==-------------------====+**#%%@@@@@@@@@@@@@@@@%%%%@@@%%%%%%%%%%%%
=-------------===---::----*%%%#+==----------------------====++*#%@@@@@@@@@@@@@@@@%%%%%@@@%%%%%%%%%%@
*++==--------------==-----:-+*+==-----------------------=====++*#@@@@@@@@@@@@@@@@%%%%@@@%%%%%%%%%%@@
++****+====------:::---==-:::=+===------::::-------------=====++*%@@@@@@@@@@@%%%%%%%%@@%%%%%%%%%%@@@
++***##+=-======-------:::==++++++==-::--:::::-----------======+*#%%%@@@@@@@%%%%%%%%@@%%%%%%%%%%%@@@
****+=---------=======----::=++++**###*=--:::::::::-::----======+#%%%%@@@@@%%%%%@%%@@@%%%%%%%%@@@@@@
#*+---------======+#%%#*+-::--------=+***+=-------:--------====+*#%%%%%@@@%%%%%%@@%%@@%%%%@%%@@@@@@@
##*+=-----=====+*%%%%%%%@#=-----------=======-----------======++*#%%%%@@@%%##%%%%%@@%%@%@@@@@@@@@@@@
####**+=-====+#%%%%%%%%%#+==--==-----========----====+*####%%#####%%%@@@%%%%%%%%@@@@@@@@@@@@@@%%@@@%
#######**+++*#%%%#%%%%%%+==-==+***#****+===------=+++++======+*##%%%@@%@%%%%%@@@@@@@@@%@%@@@%%%%@%%%
****#######*#%%*%%%%%%%*==----==========+===----=++++++==-----==+#%@@@%%%@@%@@@%%%%%%%@%%%%%%%%%%%%%
++++****######*#%%%%%%#+==--------==========----=++=+****++++===++%@@@%%%@@%%%%@%%%%%%%%%@%%%%%%%%%%
+++++++*******###%%###*==-----------=======-------=====++++*#%*++*%@@@%%@@@%%%%%%%%%%%%%%%@%%%%%%%@@
+++++++++******##%#+*#+=-------------==-------::::::---====++++++*%@%%@@@@@%%%%%@%%%%%%%%%%%%%%%%%%@
++++++++++++****##*=*#+=---=---------==------:::::::::-------===+*%@%%@@%@@%%@%%%@%%%%%%%%%@%%%%%%%%
+++++++++++++****#+==*==-:------------==--::::::::::::::::----==+*%@%@@@%%@%%%%%%%%%%%%%%%%%@%%%%%%%
++++++++++++++****+==+==--------------=-::::::::-=-----::::--===+*%%%@@@@%@@%%@%%%%%%%%%@@%%%%%%%%%
+++++++++++++++***#+=+=-------:::-----==------===++==----:::--==+*%@@@@@%%@@%%@%%%%%%%%%%%%@%@@%%%%%
+++++++++++++++***#%*+=----+=-------:::--=+====---==+=--::::---==*%@@@@@%%%@@%%@%%%@%%%%%%%@@%@@@%%@
+++++++++++++++***###+==-----==------:::::--===--==+++---------===*%@@@@%%%@@%%@@%%@@%%%%%%%@%%@@%%%
+++++++++++++++******+==---::--=-----::::::::---===+-----------====+%@@@@@@@@@%%@@%%@@%%%%%%@@@%@@%@
==+*++++++++++******#+===--------=----::::::::::----------------====+*%%%@@@@@@%@@@%@@%%%%%%%@@@@@@@
==+++**************##+==----------------:::::::::::-------------======+++*##%@@@@@@@%@@%%%%@%@@@@@@@
==+===+************##+=---==------::--==--:::::::---------------============++*#%%@@@@@@@%@@%@@@@@@@
=++====*%%%###%%%@%%*++=--=+==------::---=------::---============================++**#%@@@@@@@@@@@@@
=+====+*#@@%%##%@@#=+++=----=++=----------===-----========================+++=========++++*#%%@@@@@@
++====%%#%@@@%##*===++++-----=++==---------==================+===++++++===++++==============++++**##
++===+%%%#%@@@%##%%*++++=------======---===============+++++++++++++++++++++++++====------=======+++
+====+#%@%%%@@@@@@#+++++-==---------===================+++++++++++++++++++++++++++===-------========
+==++%%@@@@@@@@@@%*++++++-===----------==============++++++++++++**++******++++++++=====------======
#%%@@@@@@@@@@@@@%#++++++*+=-====---------======--===+++++++++++*************+++++++=================
@@@@@@@@@@@@@@@@%*+++++++*+=======-------====+++==+++++**********************+++++++================
@@@@@@@@@@@@@@@%#++=++++++**+===============++++++++++***************************+++++==============</pre>
                </div>

                <div style="margin-top: 30px;">
                    <a href="{{ route('quiz.index') }}" class="restart-btn">Retake Examination</a>
                </div>
            </div>
        </template>
    </form>
</div>

<script>
function quizApp() {
    return {
        currentIndex: 0,
        totalQuestions: 0,
        questions: [],
        quizFinished: false,
        finalScore: 0,

        nextQuestion() {
            if (this.currentIndex < this.totalQuestions - 1) {
                this.currentIndex++;
            }
        },

        prevQuestion() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            }
        },

        resetToFirst() {
            this.currentIndex = 0;
        },

        hasAnyAnswer() {
            return this.questions.some(q => q.selectedAnswer !== null);
        },

        checkCurrentAnswer() {
            this.questions[this.currentIndex].checked = true;
        },

        finishQuiz() {
            let score = 0;
            this.questions.forEach(q => {
                if (q.selectedAnswer === q.correct) {
                    score++;
                }
            });
            this.finalScore = score;
            this.quizFinished = true;
        }
    }
}
</script>
</body>
</html>