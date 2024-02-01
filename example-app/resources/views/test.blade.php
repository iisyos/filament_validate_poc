<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form name="test" action="/validateDates" method="post">
        @csrf
        <div>
            <label for="start">Start date:</label>
            <input type="date" name="start">
            @if ($errors->has('start'))
            <div>{{ $errors->first('start') }}</div>
            @endif
        </div>
        <div>
            <label for="end">End date:</label>
            <input type="date" name="end">
            @if ($errors->has('end'))
            <div>{{ $errors->first('end') }}</div>
            @endif
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>