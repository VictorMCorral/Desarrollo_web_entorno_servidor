<!-- Estilos del Footer -->
<style>
    :root {
        --footer-bg: #0f172a; /* Azul noche profundo para dar seriedad */
        --accent-gradient: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
    }

    .footer-custom {
        background-color: var(--footer-bg);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding: 2rem 0;
        margin-top: auto; /* Para que siempre esté abajo si hay poco contenido */
    }

    .footer-brand {
        font-weight: 700;
        letter-spacing: -0.5px;
        color: #f8fafc;
    }

    .footer-logo {
        width: 35px;
        height: 35px;
        border-radius: 10px;
        filter: grayscale(20%);
        transition: filter 0.3s;
    }

    .footer-custom:hover .footer-logo {
        filter: grayscale(0%);
    }

    /* Estilo de Redes Sociales */
    .social-link {
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.03);
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .social-link:hover {
        background: var(--accent-gradient);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
    }

    .footer-copy {
        color: #64748b;
        font-size: 0.85rem;
    }

    /* Enlaces sutiles */
    .footer-nav-link {
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.9rem;
        margin-left: 1.5rem;
        transition: color 0.2s;
    }

    .footer-nav-link:hover {
        color: #6366f1;
    }

    @media (max-width: 768px) {
        .footer-nav {
            margin-top: 1.5rem;
            justify-content: center;
            width: 100%;
        }
    }
</style>

<footer class="footer-custom mt-5">
    <div class="container">
        <div class="row align-items-center">

            <!-- Logo y Copyright -->
            <div class="col-md-4 text-center text-md-start">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2">
                    <img src="{{ asset('storage/img/logoN.png') }}" alt="Prieto Eats" class="footer-logo me-2">
                    <span class="footer-brand fs-5">Prieto Eats</span>
                </div>
                <p class="footer-copy mb-0">© 2025 · Crafted with passion.</p>
            </div>

            <!-- Navegación secundaria (Opcional pero elegante) -->
            <div class="col-md-4 d-none d-md-flex justify-content-center">
                <a href="#" class="footer-nav-link">Privacidad</a>
                <a href="#" class="footer-nav-link">Términos</a>
                <a href="#" class="footer-nav-link">Soporte</a>
            </div>

            <!-- Redes Sociales -->
            <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                <div class="d-flex justify-content-center justify-content-md-end gap-2">
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <i class="bi bi-twitter-x"></i> <!-- Icono X actualizado -->
                    </a>
                </div>
            </div>

        </div>
    </div>
</footer>
