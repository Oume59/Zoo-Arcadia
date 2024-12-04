<script>
    function incrementViewCount(animalName) {
        fetch(`/Consultation/increment/${animalName}`)
            .then(response => response.json())
            .then(data => console.log(data.message));
    }

    // Appelez cette fonction lorsque l'utilisateur consulte un animal
    incrementViewCount("JAVA");
</script>
