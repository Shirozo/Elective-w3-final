<nav class="custom-sidenav">
    @yield("sidenav-content")
</nav>

<script>
    const content = document.querySelectorAll(".content-title")

    content.forEach(c => {
        c.addEventListener('click', function(e) {
            setSideActive(this);
        });
    });

    const SideNavactiveLinkText = localStorage.getItem('sideActive');
    if (SideNavactiveLinkText) {
        const sideActive = Array.from(content).find(c => c.textContent === SideNavactiveLinkText);
        if (sideActive) {
            sideActive.classList.add('active');
        }
    }

    function setSideActive(sideActive) {
        content.forEach(c => c.classList.remove('active'));
        sideActive.classList.add('active');

        localStorage.setItem('sideActive', sideActive.textContent);
    }
</script>
