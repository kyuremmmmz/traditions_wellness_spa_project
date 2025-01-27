<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .input-group {
        position: relative;
        margin: 20px 0;
    }

    .input-group input {
        width: 320px;
        height: 40px;
        font-size: 16px;
        padding: 0 10px;
        background: white;
        border: 1px solid rgb(209, 213, 219);
        outline: none;
        border-radius: 5px;
        transition: border-color .3s, box-shadow .3s;
    }

    .input-group input:focus,
    .input-group input:not(:placeholder-shown) {
        border-color: #007BFF;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    }

    .input-group label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        font-size: 16px;
        color: #6B7280; 
        padding: 0 5px;
        pointer-events: none;
        transition: .5s;
        background: white;
    }

    .input-group input:focus ~ label,
    .input-group input:valid ~ label {
        top: 0;
        font-size: 12px;
        color: #007BFF;
    }

    /* Dark mode styles */
    @media (prefers-color-scheme: dark) {
        .input-group input {
            background: #333;
            border: 1px solid #555;
            color: #ddd;
        }

        .input-group label {
            color: #aaa;
            background: #333;
        }

        .input-group input:focus,
        .input-group input:not(:placeholder-shown) {
            border-color: #1E90FF;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.25);
        }

        .input-group input:focus ~ label,
        .input-group input:valid ~ label {
            color: #1E90FF;
        }
    }
</style>

<div class="input-group">
    <input type="text" required placeholder=" ">
    <label><?php echo isset($label) ? $label : "Username"; ?></label>
</div>

