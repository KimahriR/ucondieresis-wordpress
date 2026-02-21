<?php
/**
 * Template: Front Page (Homepage)
 * 
 * @package Ucondieresis
 */

get_header();
?>

<main id="main" class="site-main home-page">
    
    <!-- Hero Section -->
    <section class="hero-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 80px 20px; text-align: center;">
        <div class="hero-content" style="max-width: 800px; margin: 0 auto;">
            <h1 class="hero-title" style="font-size: 48px; margin: 0 0 20px 0; font-weight: bold; line-height: 1.2;">
                <?php esc_html_e('Productos Personalizados, Diseñados para Ti', 'ucondieresis'); ?>
            </h1>
            <p class="hero-subtitle" style="font-size: 20px; margin: 0 0 30px 0; opacity: 0.95; line-height: 1.6;">
                <?php esc_html_e('Transforma tus ideas en productos únicos. Calidad premium con personalización sin límites.', 'ucondieresis'); ?>
            </p>
            <a href="#productos-destacados" class="hero-cta" style="display: inline-block; padding: 15px 40px; background: #25D366; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; transition: all 0.3s ease;">
                <?php esc_html_e('Ver Nuestros Productos', 'ucondieresis'); ?>
            </a>
        </div>
    </section>
    
    <!-- Características -->
    <section class="features-section" style="padding: 60px 20px; background: #f5f5f5;">
        <div class="features-container" style="max-width: 1200px; margin: 0 auto;">
            <h2 class="section-title" style="text-align: center; font-size: 32px; margin-bottom: 40px; color: #333;">
                <?php esc_html_e('¿Por Qué Elegirnos?', 'ucondieresis'); ?>
            </h2>
            
            <div class="features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                
                <!-- Feature 1 -->
                <div class="feature-card" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
                    <div class="feature-icon" style="font-size: 48px; margin-bottom: 15px;">🎨</div>
                    <h3 style="margin: 0 0 10px 0; color: #333;">
                        <?php esc_html_e('Personalización Total', 'ucondieresis'); ?>
                    </h3>
                    <p style="margin: 0; color: #666; line-height: 1.6;">
                        <?php esc_html_e('Diseña exactamente lo que imaginas. Tus ideas, tu estilo, tu producto.', 'ucondieresis'); ?>
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
                    <div class="feature-icon" style="font-size: 48px; margin-bottom: 15px;">⚡</div>
                    <h3 style="margin: 0 0 10px 0; color: #333;">
                        <?php esc_html_e('Entrega Rápida', 'ucondieresis'); ?>
                    </h3>
                    <p style="margin: 0; color: #666; line-height: 1.6;">
                        <?php esc_html_e('Producción ágil sin comprometer calidad. Listos en tiempo récord.', 'ucondieresis'); ?>
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center;">
                    <div class="feature-icon" style="font-size: 48px; margin-bottom: 15px;">💎</div>
                    <h3 style="margin: 0 0 10px 0; color: #333;">
                        <?php esc_html_e('Calidad Premium', 'ucondieresis'); ?>
                    </h3>
                    <p style="margin: 0; color: #666; line-height: 1.6;">
                        <?php esc_html_e('Materiales de primera calidad. Acabados impecables en cada detalle.', 'ucondieresis'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Productos Destacados -->
    <section id="productos-destacados" class="featured-products-section" style="padding: 60px 20px; background: white;">
        <div class="featured-container" style="max-width: 1200px; margin: 0 auto;">
            <h2 class="section-title" style="text-align: center; font-size: 32px; margin-bottom: 10px; color: #333;">
                <?php esc_html_e('Nuestros Productos Destacados', 'ucondieresis'); ?>
            </h2>
            <p class="section-subtitle" style="text-align: center; color: #666; margin-bottom: 40px; font-size: 16px;">
                <?php esc_html_e('Descubre nuestra selección de productos más populares y cotizados.', 'ucondieresis'); ?>
            </p>
            
            <?php
            // Renderizar grid de productos destacados
            $featured_html = ucondieresis_render_featured_products_grid(6, 3);
            if (!empty($featured_html)) {
                echo $featured_html;
            } else {
                echo '<p style="text-align: center; color: #999; padding: 40px 20px;">';
                esc_html_e('No hay productos destacados aún. ¡Pronto actualizaremos nuestra galería!', 'ucondieresis');
                echo '</p>';
            }
            ?>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 60px 20px; text-align: center;">
        <div class="cta-container" style="max-width: 800px; margin: 0 auto;">
            <h2 style="font-size: 32px; margin: 0 0 20px 0;">
                <?php esc_html_e('¿Tienes una idea?', 'ucondieresis'); ?>
            </h2>
            <p style="font-size: 18px; margin: 0 0 30px 0; opacity: 0.95;">
                <?php esc_html_e('Cotiza tu producto personalizado con nosotros. Es rápido, fácil y sin compromiso.', 'ucondieresis'); ?>
            </p>
            <a href="<?php echo esc_url(get_page_link(get_option('page_for_posts'))); ?>" class="cta-button" style="display: inline-block; padding: 15px 40px; background: #25D366; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; transition: all 0.3s ease;">
                <svg style="display: inline; width: 20px; height: 20px; margin-right: 8px; vertical-align: middle;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.52 3.48C19.64 2.61 18.42 2.61 17.54 3.48L3.97 17.05C3.25 17.77 2.89 18.72 2.99 19.67L3.65 25.42C3.77 26.46 4.64 27.27 5.69 27.27C5.79 27.27 5.89 27.27 5.99 27.25L11.74 26.59C12.69 26.49 13.64 26.13 14.36 25.41L27.93 11.84C29.71 10.06 29.71 7.21 27.93 5.43L20.52 3.48ZM5.41 25.38L4.75 19.63C4.73 19.43 4.81 19.23 4.97 19.07L18.54 5.5L21.07 8.03L7.5 21.6C7.34 21.76 7.14 21.84 6.94 21.86L5.41 25.38Z"/>
                </svg>
                <?php esc_html_e('Cotiza Ahora por WhatsApp', 'ucondieresis'); ?>
            </a>
        </div>
    </section>
    
    <!-- Testimonios / Social Proof -->
    <section class="testimonials-section" style="padding: 60px 20px; background: #f9f9f9;">
        <div class="testimonials-container" style="max-width: 1200px; margin: 0 auto;">
            <h2 class="section-title" style="text-align: center; font-size: 32px; margin-bottom: 40px; color: #333;">
                <?php esc_html_e('Lo Que Dicen Nuestros Clientes', 'ucondieresis'); ?>
            </h2>
            
            <div class="testimonials-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                
                <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="testimonial-card" style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div style="margin-bottom: 15px;">
                        <span style="color: #FFD700; font-size: 18px;">★★★★★</span>
                    </div>
                    <p style="margin: 0 0 15px 0; color: #666; line-height: 1.6; font-size: 14px;">
                        <?php esc_html_e('"Excelente calidad y atención. Mi pedido llegó antes de lo esperado y se ve increíble. ¡Altamente recomendado!"', 'ucondieresis'); ?>
                    </p>
                    <p style="margin: 0; color: #333; font-weight: bold; font-size: 14px;">
                        <?php echo esc_html(sprintf(__('Cliente %d', 'ucondieresis'), $i)); ?>
                    </p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>
    
</main>

<style>
    .home-page .section-title {
        font-weight: bold;
    }
    
    .hero-cta:hover,
    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
    }
    
    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 20px !important;
        }
        
        .hero-title {
            font-size: 32px !important;
        }
        
        .hero-subtitle {
            font-size: 16px !important;
        }
        
        .section-title {
            font-size: 24px !important;
        }
        
        .features-grid, .testimonials-grid {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<?php
get_footer();
