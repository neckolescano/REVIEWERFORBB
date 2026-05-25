<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #2c3e50; }
        .score-box { text-align: center; padding: 20px; background: #e8f8f5; border: 2px solid #2ecc71; border-radius: 8px; margin-bottom: 30px; }
        .score-num { font-size: 3em; font-weight: bold; color: #27ae60; }
        .item-card { padding: 15px; margin-bottom: 20px; border-radius: 5px; border-left: 5px solid; }
        .correct { background-color: #e8f8f5; border-color: #2ecc71; }
        .wrong { background-color: #fdebd0; border-color: #e67e22; }
        .status-badge { display: inline-block; padding: 3px 8px; font-weight: bold; border-radius: 3px; font-size: 0.85em; margin-bottom: 5px; color: white; }
        .bg-correct { background-color: #2ecc71; }
        .bg-wrong { background-color: #e67e22; }
        .btn-retry { display: inline-block; text-align: center; padding: 12px 25px; background: #3498db; color: white; text-decoration: none; font-weight: bold; border-radius: 4px; margin-top: 15px; }
        .btn-retry:hover { background: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Performance Summary</h1>
        
        <div class="score-box">
            <div>Your Total Score:</div>
            <div class="score-num">{{ $score }} / {{ count($questions) }}</div>
            <div>Percentage: {{ round(($score / count($questions)) * 100, 2) }}%</div>
            <a href="{{ route('quiz.index') }}" class="btn-retry">Retake Examination</a>
        </div>

        <h2>Detailed Item Review</h2>
        @foreach($results as $id => $res)
            <div class="item-card {{ $res['is_correct'] ? 'correct' : 'wrong' }}">
                <span class="status-badge {{ $res['is_correct'] ? 'bg-correct' : 'bg-wrong' }}">
                    {{ $res['is_correct'] ? 'CORRECT' : 'WRONG' }}
                </span>
                
                <div style="font-weight: bold; margin-bottom: 8px;">{{ $id }}. {{ $res['question'] }}</div>
                
                <div style="font-size: 0.95em; margin-left: 10px;">
                    @foreach($res['options'] as $letter => $text)
                        @if(!empty($text))
                        <div style="margin: 3px 0; {{ $letter === $res['correct_answer'] ? 'color: #27ae60; font-weight: bold;' : '' }}">
                            {{ $letter }}. {{ $text }} 
                            @if($letter === $res['user_answer']) 
                                <span style="font-style: italic; color: #2c3e50;">(You chose this)</span>
                            @endif
                            @if($letter === $res['correct_answer'])
                                <span style="font-weight: bold;">✓ (Correct Answer)</span>
                            @endif
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>