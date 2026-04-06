
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const texts = document.querySelectorAll('.sidebar-text');
        const title = document.getElementById('sidebar-title');

        if (sidebar.classList.contains('w-64')) {
            sidebar.classList.remove('w-64');
            sidebar.classList.add('w-16');
            texts.forEach(el => el.style.display = 'none');
            title.style.display = 'none';
        } else {
            sidebar.classList.remove('w-16');
            sidebar.classList.add('w-64');
            texts.forEach(el => el.style.display = 'block');
            title.style.display = 'block';
        }
    }
</script>
