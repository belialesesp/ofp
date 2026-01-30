<?php
$title = get_field('title');
$guides = get_field('guides');
$link_text = get_field('link_text');
$link_url = get_field('link_url');
?>

<section class="guides-section">
    <div class="container">
        

        
        <?php if ($guides): ?>
            <div class="guides-content">
                
                <!-- Primeira DIV: Título, primeiro guide e botão -->
                <div class="guides-left">
                        <?php if ($title): ?>
            <h2 class="guides-section__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
                    <?php 
                    $first_guide = $guides[0]; // Primeiro item do repetidor
                    if ($first_guide): ?>
                        <div class="guide-card guide-card--main">
                            <?php if (!empty($first_guide['image'])): ?>
                                <div class="guide-card__image" style="background-image: url('<?php echo esc_url($first_guide['image']['url']); ?>');">
                                    <div class="guide-card__overlay">
                                        <?php if (!empty($first_guide['title'])): ?>
                                            <h3 class="guide-card__title"><?php echo esc_html($first_guide['title']); ?></h3>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="guide-card__content">
                                <?php if (!empty($first_guide['description'])): ?>
                                    <p class="guide-card__description"><?php echo esc_html($first_guide['description']); ?></p>
                                <?php endif; ?>
                                
                                <?php if ($link_text && $link_url): ?>
                                    <div class="guides-section__cta">
                                        <a href="<?php echo esc_url($link_url); ?>" class="guides-cta-button">
                                            <?php echo esc_html($link_text); ?>
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.7827 8.66406H2.66602V7.33073H10.7827L7.04935 3.5974L7.99935 2.66406L13.3327 7.9974L7.99935 13.3307L7.04935 12.3974L10.7827 8.66406Z" fill="currentColor" />
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Segunda DIV: Outros guides (índice 1 e 2) -->
                <div class="guides-right">
                    <?php 
                    // Pega os outros itens do repetidor (a partir do índice 1)
                    $other_guides = array_slice($guides, 1);
                    if ($other_guides):
                        foreach ($other_guides as $guide): ?>
                            <div class="guide-card guide-card--secondary">
                                <?php if (!empty($guide['image'])): ?>
                                    <div class="guide-card__image" style="background-image: url('<?php echo esc_url($guide['image']['url']); ?>');">
                                        <div class="guide-card__overlay">
                                            <?php if (!empty($guide['title'])): ?>
                                                <h3 class="guide-card__title"><?php echo esc_html($guide['title']); ?></h3>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (!empty($guide['description'])): ?>
                                    <div class="guide-card__content">
                                        <p class="guide-card__description"><?php echo esc_html($guide['description']); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
                
            </div>
        <?php endif; ?>
        
    </div>
</section>