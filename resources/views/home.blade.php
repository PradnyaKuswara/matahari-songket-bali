<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>

    <button class="btn" onclick="my_modal_2.showModal()">open modal</button>
    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Hello!</h3>
            <p class="py-4">Press ESC key or click outside to close</p>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <input id="mode" type="checkbox" value="dark" class="toggle theme-controller" />

    <script src="{{ asset('assets/js/color-mode.js') }}"></script>
</body>

</html>
