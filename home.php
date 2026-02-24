<?php
get_header();
?>

<main id="primary" class="site-main blog-page">
    <div class="container">        
        <section class="blog-header">
            <h1 class="blog-title">
                <span class="blog-title__prefix">the</span>
                <span class="blog-title__main">
                    <?php
                    $blog_page_id = get_option('page_for_posts');
                    echo esc_html(get_the_title($blog_page_id));
                    ?>
                </span>
            </h1>

            <nav class="blog-categories" role="navigation" aria-label="Category filters">
                <div class="category-row category-row--primary">
                    <button class="category-button category-button--active" 
                            data-filter="all" 
                            aria-pressed="true"
                            style="background-color: #FFD6D9;">
                        All
                    </button>
                    
                    <?php
                    $parent_categories = get_categories(array(
                        'parent'      => 0,
                        'orderby'     => 'name',
                        'order'       => 'ASC',
                        'exclude'     => array(get_cat_ID('Uncategorized')),
                        'hide_empty'  => true
                    ));

                    $colors = array('#FFD6D9', '#BED8BA', '#9BBFCD', '#F1CAB9');
                    $color_index = 1;

                    foreach ($parent_categories as $category) :
                        $category_name = esc_html($category->name);
                        $category_slug = esc_attr($category->slug);
                        $category_id = $category->term_id;
                        
                        $child_categories = get_categories(array(
                            'parent'     => $category_id,
                            'hide_empty' => true
                        ));
                        $has_children = !empty($child_categories);
                        
                        $bg_color = $colors[$color_index % count($colors)];
                        $color_index++;
                    ?>
                        <button class="category-button" 
                                data-filter="<?php echo $category_slug; ?>"
                                data-category-id="<?php echo $category_id; ?>"
                                data-has-children="<?php echo $has_children ? 'true' : 'false'; ?>"
                                data-level="primary"
                                style="background-color: <?php echo $bg_color; ?>;"
                                aria-pressed="false">
                            <?php echo $category_name; ?>
                            <?php if ($has_children) : ?>
                                <span class="has-children-indicator">▼</span>
                            <?php endif; ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                
                <div class="category-row category-row--secondary" style="display: none;"></div>
                <div class="category-row category-row--tertiary" style="display: none;"></div>
            </nav>

            <?php
            $all_categories = get_categories(array(
                'orderby'    => 'name',
                'order'      => 'ASC',
                'exclude'    => array(get_cat_ID('Uncategorized')),
                'hide_empty' => true
            ));
            
            $categories_data = array();
            foreach ($all_categories as $cat) {
                $categories_data[$cat->term_id] = array(
                    'id'     => $cat->term_id,
                    'name'   => $cat->name,
                    'slug'   => $cat->slug,
                    'parent' => $cat->parent
                );
            }
            ?>
            <script>
                window.categoriesData = <?php echo json_encode($categories_data); ?>;
            </script>
        </section>
        
        <?php
        // Get the newest post title
        $latest_post = wp_get_recent_posts(array(
            'numberposts' => 1,
            'post_status' => 'publish'
        ));
        
        if (!empty($latest_post)) :
            $newest_title = get_the_title($latest_post[0]['ID']);
        ?>
        <div class="newest-post-header">
            <div class="newest-post-title"><?php echo esc_html($newest_title); ?></div>
            <div class="newest-label">NEWEST</div>
        </div>
        <?php endif; ?>
        
        <section class="blog-listing">
            <div class="post-list" id="posts-container">
                <?php
                $query_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 12,
                    'paged'          => 1,
                    'post_status'    => 'publish'
                );
                
                $posts_query = new WP_Query($query_args);

                if ($posts_query->have_posts()) :
                    while ($posts_query->have_posts()) : $posts_query->the_post();
                        $post_categories = get_the_category();
                        $cat_classes = array();
                        
                        foreach ($post_categories as $cat) {
                            $cat_classes[] = esc_attr($cat->slug);
                        }
                        $cat_classes_string = implode(' ', $cat_classes);
                ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class($cat_classes_string); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium_large'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                            <a href="<?php the_permalink(); ?>" class="read-post-link">
                                READ POST <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <div class="no-posts">
                        <p>No posts found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($posts_query->found_posts > 12) : ?>
                <div class="load-more-container">
                    <button id="load-more" 
                            class="load-more-btn" 
                            data-page="1"
                            data-max-pages="<?php echo $posts_query->max_num_pages; ?>">
                        <span class="load-more-btn__text">Load More</span>
                        <span class="load-more-btn__loader" style="display: none;">Loading...</span>
                    </button>
                </div>
            <?php endif; ?>
        </section>
    </div>
<?php
$blog_page_id = get_option('page_for_posts');
if ($blog_page_id) {
    $blog_page_content = get_post_field('post_content', $blog_page_id);
    if (!empty($blog_page_content)) {
        echo '<div class="blog-page-content">';
        echo apply_filters('the_content', $blog_page_content);
        echo '</div>';
    }
}
?>
    
    <div class="blog-loading-overlay" id="blog-loading-overlay">
        <div class="blog-loading-content">
            <div class="blog-loading-spinner"></div>
        </div>
    </div>
</main>

<script>
class BlogFilters {
    constructor() {
        this.posts = document.querySelectorAll('.post-list div[id^="post-"]');
        this.categoryRows = {
            primary: document.querySelector('.category-row--primary'),
            secondary: document.querySelector('.category-row--secondary'),
            tertiary: document.querySelector('.category-row--tertiary')
        };
        this.categoriesData = window.categoriesData || {};
        this.currentSelection = {
            primary: null,
            secondary: null,
            tertiary: null
        };
        this.loadingOverlay = document.getElementById('blog-loading-overlay');
        this.isLoading = false;
        this.init();
    }

    init() {
        this.bindEventListeners();
    }

    bindEventListeners() {
    document.addEventListener('click', (e) => {
        let button = null;
        
        if (e.target.classList.contains('category-button')) {
            button = e.target;
        } else if (e.target.closest('.category-button')) {
            button = e.target.closest('.category-button');
        }
        
        if (button && !button.disabled && !this.isLoading) {
            this.handleCategoryClick(button);
        }
    });
}

    showLoading(message = 'Carregando...') {
        if (this.loadingOverlay) {
            const loadingText = this.loadingOverlay.querySelector('.blog-loading-text');
            if (loadingText) {
                loadingText.textContent = message;
            }
            this.loadingOverlay.classList.add('active');
            this.isLoading = true;
            this.disableAllButtons();
        }
    }

    hideLoading() {
        if (this.loadingOverlay) {
            this.loadingOverlay.classList.remove('active');
            this.isLoading = false;
            this.enableAllButtons();
        }
    }

    disableAllButtons() {
        document.querySelectorAll('.category-button').forEach(btn => {
            btn.disabled = true;
        });
        document.body.style.pointerEvents = 'none';
        this.loadingOverlay.style.pointerEvents = 'auto';
    }

    enableAllButtons() {
        document.querySelectorAll('.category-button').forEach(btn => {
            btn.disabled = false;
        });
        document.body.style.pointerEvents = 'auto';
    }

    async handleCategoryClick(button) {
        const filter = button.getAttribute('data-filter');
        const categoryId = button.getAttribute('data-category-id');
        const hasChildren = button.getAttribute('data-has-children') === 'true';
        const level = button.getAttribute('data-level') || 'primary';

        if (filter === 'all') {
            this.showLoading('Loading');
        } else if (hasChildren) {
            this.showLoading('Loading');
        } else {
            this.showLoading('Loading');
        }

        try {
            await new Promise(resolve => setTimeout(resolve, 100));

            this.updateSelectionState(level, categoryId, filter);
            
            this.updateActiveButton(button, level);

            if (filter === 'all') {
                this.clearAllSelections();
                this.hideAllSubcategories();
                await this.loadCategoryPosts('all');
                return;
            }

            await this.handleCategoryLevel(level, categoryId, filter, hasChildren);

        } catch (error) {
            console.error('Erro ao processar categoria:', error);
        } finally {
            this.hideLoading();
        }
    }

    updateSelectionState(level, categoryId, filter) {
        if (level === 'primary') {
            this.currentSelection.primary = { id: categoryId, filter: filter };
            this.currentSelection.secondary = null;
            this.currentSelection.tertiary = null;
        } else if (level === 'secondary') {
            this.currentSelection.secondary = { id: categoryId, filter: filter };
            this.currentSelection.tertiary = null;
        } else if (level === 'tertiary') {
            this.currentSelection.tertiary = { id: categoryId, filter: filter };
        }
    }

    async handleCategoryLevel(level, categoryId, filter, hasChildren) {
        switch (level) {
            case 'primary':
                this.hideSubcategories('secondary');
                this.hideSubcategories('tertiary');
                
                if (hasChildren) {
                    await new Promise(resolve => setTimeout(resolve, 300));
                    this.showSubcategories(categoryId, 'secondary');
                } else {
                    await this.loadCategoryPosts(filter);
                }
                break;

            case 'secondary':
                this.hideSubcategories('tertiary');
                
                if (hasChildren) {
                    await new Promise(resolve => setTimeout(resolve, 300));
                    this.showSubcategories(categoryId, 'tertiary');
                } else {
                    await this.loadCategoryPosts(filter);
                }
                break;

            case 'tertiary':
                await this.loadCategoryPosts(filter);
                break;
        }
    }

    showSubcategories(parentId, targetLevel) {
        const subcategories = this.getChildCategories(parentId);
        
        if (subcategories.length === 0) {
            return;
        }

        const parentColor = this.getParentColor(targetLevel);
        const targetRow = this.categoryRows[targetLevel];
        
        let html = '';

        subcategories.forEach(category => {
            const childCategories = this.getChildCategories(category.id);
            const hasChildren = childCategories.length > 0;
            
            html += `<button class="category-button" 
                            data-filter="${category.slug}"
                            data-category-id="${category.id}"
                            data-has-children="${hasChildren}"
                            data-level="${targetLevel}"
                            style="background-color: ${parentColor};">
                        ${category.name}
                        ${hasChildren ? '<span class="has-children-indicator">▼</span>' : ''}
                    </button>`;
        });

        targetRow.innerHTML = html;
        targetRow.style.display = 'block';
        
        targetRow.style.opacity = '0';
        targetRow.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            targetRow.style.opacity = '1';
            targetRow.style.transform = 'translateY(0)';
            targetRow.style.transition = 'all 0.3s ease';
        }, 50);
    }

    getParentColor(targetLevel) {
        if (targetLevel === 'secondary') {
            const activeButton = document.querySelector('.category-row--primary .category-button--active');
            return activeButton ? activeButton.style.backgroundColor : '#FFD6D9';
        } else if (targetLevel === 'tertiary') {
            const activeButton = document.querySelector('.category-row--secondary .category-button--active');
            return activeButton ? activeButton.style.backgroundColor : '#FFD6D9';
        }
        return '#FFD6D9';
    }

    hideSubcategories(level) {
        if (this.categoryRows[level]) {
            this.categoryRows[level].style.display = 'none';
            this.categoryRows[level].innerHTML = '';
        }
    }

    hideAllSubcategories() {
        this.hideSubcategories('secondary');
        this.hideSubcategories('tertiary');
    }

    clearAllSelections() {
        this.currentSelection = {
            primary: null,
            secondary: null,
            tertiary: null
        };
    }

    updateActiveButton(activeButton, level) {
        const levelClass = `.category-row--${level}`;
        document.querySelectorAll(`${levelClass} .category-button`).forEach(btn => {
            btn.classList.remove('category-button--active');
            btn.setAttribute('aria-pressed', 'false');
        });
        
        if (activeButton.getAttribute('data-filter') !== 'all') {
            if (level === 'primary') {
                document.querySelectorAll('.category-row--secondary .category-button, .category-row--tertiary .category-button').forEach(btn => {
                    btn.classList.remove('category-button--active');
                    btn.setAttribute('aria-pressed', 'false');
                });
            } else if (level === 'secondary') {
                document.querySelectorAll('.category-row--tertiary .category-button').forEach(btn => {
                    btn.classList.remove('category-button--active');
                    btn.setAttribute('aria-pressed', 'false');
                });
            }
        } else {
            document.querySelectorAll('.category-button').forEach(btn => {
                if (btn !== activeButton) {
                    btn.classList.remove('category-button--active');
                    btn.setAttribute('aria-pressed', 'false');
                }
            });
        }
        
        activeButton.classList.add('category-button--active');
        activeButton.setAttribute('aria-pressed', 'true');
    }

    async loadCategoryPosts(categorySlug) {
        const postsContainer = document.querySelector('.post-list');
        
        try {
            const formData = new FormData();
            formData.append('action', 'get_filtered_posts');
            formData.append('category', categorySlug);
            formData.append('posts_per_page', '12');

            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();
            
            if (data.success) {
                postsContainer.innerHTML = data.data.posts;
                this.updateLoadMoreButton(data.data.has_more, 1, data.data.max_pages, categorySlug);
                this.posts = document.querySelectorAll('.post-list div[id^="post-"]');
                this.hideNoPostsMessage();
                
                if (data.data.post_count === 0) {
                    this.showNoPostsMessage(categorySlug);
                }
            }
        } catch (error) {
            console.error('Error loading category posts:', error);
        }
    }

    updateLoadMoreButton(hasMore, currentPage, maxPages, category) {
        const loadMoreBtn = document.getElementById('load-more');
        const loadMoreContainer = document.querySelector('.load-more-container');
        
        if (loadMoreBtn && loadMoreContainer) {
            if (hasMore) {
                loadMoreBtn.style.display = 'block';
                loadMoreContainer.style.display = 'block';
                loadMoreBtn.setAttribute('data-page', currentPage);
                loadMoreBtn.setAttribute('data-max-pages', maxPages);
                loadMoreBtn.setAttribute('data-category', category);
                
                if (window.loadMoreInstance) {
                    window.loadMoreInstance.currentPage = currentPage;
                    window.loadMoreInstance.currentCategory = category;
                }
            } else {
                loadMoreBtn.style.display = 'none';
                loadMoreContainer.style.display = 'none';
            }
        }
    }

    getChildCategories(parentId) {
        return Object.values(this.categoriesData).filter(cat => 
            parseInt(cat.parent) === parseInt(parentId)
        );
    }

    showNoPostsMessage(filter) {
        let messageDiv = document.querySelector('.no-posts-filtered');
        
        if (!messageDiv) {
            messageDiv = document.createElement('div');
            messageDiv.className = 'no-posts-filtered';
            document.querySelector('.post-list').appendChild(messageDiv);
        }
        
        const categoryName = this.getCurrentCategoryName(filter);
        messageDiv.innerHTML = `<p>Nenhum post encontrado na categoria "${categoryName}".</p>`;
        messageDiv.style.display = 'block';
    }

    hideNoPostsMessage() {
        const messageDiv = document.querySelector('.no-posts-filtered');
        if (messageDiv) {
            messageDiv.style.display = 'none';
        }
    }

    getCurrentCategoryName(slug) {
        const category = Object.values(this.categoriesData).find(cat => cat.slug === slug);
        return category ? category.name : slug;
    }
}

class LoadMorePosts {
    constructor() {
        this.loadMoreBtn = document.getElementById('load-more');
        this.postsContainer = document.querySelector('.post-list');
        this.currentPage = 1;
        this.currentCategory = 'all';
        this.isLoading = false;
        
        if (this.loadMoreBtn) {
            this.init();
        }
    }

    init() {
        this.loadMoreBtn.addEventListener('click', () => this.loadMore());
    }

    async loadMore() {
        if (this.isLoading) return false;

        this.isLoading = true;
        this.updateButtonState(true);
        this.currentPage++;

        const blogFilters = window.blogFiltersInstance;
        if (blogFilters) {
            blogFilters.showLoading('Carregando mais posts...');
        }

        try {
            const formData = new FormData();
            formData.append('action', 'get_filtered_posts');
            formData.append('category', this.currentCategory);
            formData.append('page', this.currentPage);
            formData.append('posts_per_page', '12');

            const response = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success && data.data.posts.trim() !== '') {
                this.postsContainer.insertAdjacentHTML('beforeend', data.data.posts);
                this.updatePostsReference();
                
                if (!data.data.has_more) {
                    this.hideLoadMoreButton();
                }
                
                return true;
            } else {
                this.hideLoadMoreButton();
                return false;
            }
        } catch (error) {
            console.error('Error loading more posts:', error);
            this.currentPage--;
            return false;
        } finally {
            this.isLoading = false;
            this.updateButtonState(false);
            
            if (blogFilters) {
                blogFilters.hideLoading();
            }
        }
    }

    updateButtonState(loading) {
        if (!this.loadMoreBtn) return;
        
        const text = this.loadMoreBtn.querySelector('.load-more-btn__text');
        const loader = this.loadMoreBtn.querySelector('.load-more-btn__loader');
        
        if (text && loader) {
            text.style.display = loading ? 'none' : 'inline';
            loader.style.display = loading ? 'inline' : 'none';
        }
        
        this.loadMoreBtn.disabled = loading;
    }

    updatePostsReference() {
        const blogFilters = window.blogFiltersInstance;
        if (blogFilters) {
            blogFilters.posts = document.querySelectorAll('.post-list div[id^="post-"]');
            blogFilters.hideNoPostsMessage();
        }
    }

    hideLoadMoreButton() {
        if (this.loadMoreBtn) {
            this.loadMoreBtn.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    window.blogFiltersInstance = new BlogFilters();
    window.loadMoreInstance = new LoadMorePosts();
});
</script>

<style>
.newest-post-header {
	width: 100%;
	font-family: 'Versailles';
    line-height: 100px;
    border-top: solid 1px #BED8BA;
    border-bottom: solid 1px #BED8BA;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 0 20px 0;
    padding: 0;
    font-size: 30px;
    text-transform: uppercase;
}

.newest-post-title {
    flex: 1;
    text-align: left;
    font-weight: 400;
}

.newest-label {
    text-align: right;
    font-weight: 400;
    font-family: 'GlacialIndifference';
}

@media (max-width: 768px) {
    .newest-post-header {
        font-size: 12px;
        letter-spacing: 1px;
        margin: 20px 0 15px 0;
    }
}
</style>

<?php
get_footer();
?>