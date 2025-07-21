// Dès que la page est chargée pour les personnes collectées
    document.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('alert-box');
        if (alertBox) {
            // Après 3 secondes, cache la div (avec transition)
            setTimeout(() => {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }, 3000); // 3000 ms = 3 secondes
        }
    });

// Script recherche pour les admin
$(document).ready(function () {
    $('#searchInput').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('admin.collectes.search') }}",
            type: 'GET',
            data: { query: query },
            success: function (data) {
                $('#collecteTableBody').html(data);

                // Réinitialise les modals dynamiques
                document.querySelectorAll('[data-bs-toggle="modal"]').forEach(el => {
                    el.addEventListener('click', function () {
                        const target = document.querySelector(this.dataset.bsTarget);
                        const modal = new bootstrap.Modal(target);
                        modal.show();
                    });
                });
            }
        });
    });
});


// Script recherche pour les utilisateurs normaux
$(document).ready(function () {
    let delayTimer;

    $('#searchInput').on('keyup', function () {
        clearTimeout(delayTimer);
        let query = $(this).val();

        delayTimer = setTimeout(function () {
            $.ajax({
                url: "{{ route('user.collectes.search') }}",
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    $('#collecteTableBody').html(data);

                    // Réattacher les modaux
                    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(el => {
                        el.addEventListener('click', function () {
                            const target = document.querySelector(this.dataset.bsTarget);
                            const modal = new bootstrap.Modal(target);
                            modal.show();
                        });
                    });
                }
            });
        }, 300); // 300 ms de délai pour ne pas spammer le serveur
    });
});
