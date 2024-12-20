<script src="/template/client/js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="/template/client/js/plugins.js"></script>
<script src="/template/client/js/script.js"></script>
<script>
    document.getElementById('category-select').addEventListener('change', function () {
    const selectedValue = this.value;
    if (selectedValue) {
        window.location.hash = selectedValue;
    }
});
</script>