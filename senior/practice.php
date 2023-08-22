<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="create_acc.php" id="form" method="post">
        <input type="text" placeholder="Enter text" id="input">
        <input type="date" id="date-birth">
        <button id="date-button">click me</button>
        <input type="submit">
    </form>
</body>

<script>
    const form = document.getElementById("form");
    const text = document.getElementById("input");
    const bruh = document.getElementById("date-button");

    bruh.addEventListener("click", ()=>{
    const birth_input = document.getElementById("date-birth").value;
    const birth_val = new Date(birth_input);

    //well have to calculate the month difference first
    const month_diff = Date.now() - birth_val;

    // convert the calculated difference in date format
    const age_dt = new Date(month_diff);

    //extract year from date then calculate the age of the user
    const year = age_dt.getUTCFullYear();
    const age = Math.abs(year - 1970);
    console.log(age);
    });
        


    form.addEventListener("submit", (e)=>{
    const birth_input = document.getElementById("date-birth").value;
    const birth_val = new Date(birth_input);

    //well have to calculate the month difference first
    const month_diff = Date.now() - birth_val;

    // convert the calculated difference in date format
    const age_dt = new Date(month_diff);

    //extract year from date then calculate the age of the user
    const year = age_dt.getUTCFullYear();
    const age = Math.abs(year - 1970);
    console.log(age);

        if(text.value == ""){
            e.preventDefault();
        }
        if(age < 60){
            alert("you are younger than 60");
            e.preventDefault();
        }
        
    });
    
</script>
</html>