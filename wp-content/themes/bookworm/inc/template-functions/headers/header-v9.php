<?php
/**
 * Template Functions for Header v9 Template
 *
 * @package bookworm
 */

if ( ! function_exists( 'bookworm_masthead_v9' ) ) {
    /**
     * Displays Masthead for Header v9
     *
     * @return void
     */
    function bookworm_masthead_v9() {
        ?><div class="masthead">
            <?php
            do_action( 'bookworm_masthead_v9_content_before' );
            ?>
            <div class="masthead-topbar<?php echo bookworm_header_is_sticky() ? ' navbar-sticky' : ''; ?>">
                <div class="container pt-3 pt-md-4 pb-3 pb-md-5">
                    <div class="d-flex align-items-center position-relative flex-wrap">
                        <?php
                        do_action( 'bookworm_masthead_v9' );
                        ?>
                    </div>
                </div>
            </div>
            <?php
            do_action( 'bookworm_masthead_v9_content_after' );
            ?>
        </div><?php
    }
}

if ( ! function_exists( 'bookworm_offcanvas_toggler_v9' ) ) {
    /**
     * Displays Offcanvas Toggler v9
     *
     * @return void
     */
    function bookworm_offcanvas_toggler_v9() {
        bookworm_offcanvas_toggler( 'mr-4', true );
    }
}

if ( ! function_exists( 'bookworm_site_branding_v9' ) ) {
    /**
     * Displays Site Branding in Header v9
     *
     * @return void
     */
    function bookworm_site_branding_v9() {
        ?><div class="site-branding pr-1 pr-md-7">
            <?php bookworm_site_title_or_logo( true, 'site-title text-uppercase font-weight-bold font-size-5 m-0' ); ?>
        </div><?php
    }
}

if ( ! function_exists( 'bookworm_site_search_v9' ) ) {
    /**
     * Displays Site Search in Header v9
     *
     * @return void
     */
    function bookworm_site_search_v9() {
        if ( apply_filters('bookworm_enable_site_search' , true )):
        ?>
        <div class="site-search ml-xl-0 ml-md-auto w-r-100 flex-grow-1 mr-md-5 mt-2 mt-md-0 order-1 order-md-0">
            <?php if ( bookworm_is_woocommerce_activated() ) : ?>
                <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-inline my-2 my-xl-0">
                    <div class="input-group input-group-borderless w-100">
                        <div class="input-group-prepend border-right mr-0 d-none d-xl-block">
                            <?php $selected_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : 0;
                            $navbar_search_dropdown_text = apply_filters( 'bookworm_navbar_search_category_dropdown_default_text', esc_html__( 'All Categories', 'bookworm' ) );
                            wp_dropdown_categories( apply_filters( 'bookworm_search_dropdown_categories_filter_args', array(
                                'show_option_all'   => $navbar_search_dropdown_text,
                                'taxonomy'          => 'product_cat',
                                'hide_if_empty'     => 1,
                                'name'              => 'product_cat',
                                'selected'          => $selected_cat,
                                'value_field'       => 'slug',
                                'id'                => 'inputGroupSelect01',
                                'class'             => 'custom-select pr-7 pl-4 rounded-right-0 height-5 shadow-none border-0 text-dark bg-gray-200'
                            ) ) );
                            ?>
                        </div>
                        <input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" class="form-control px-3 bg-gray-200 bg-focus__1" placeholder="<?php esc_attr_e( 'Search for books by keyword', 'bookworm' ); ?>" aria-label="<?php esc_attr_e( 'Amount (to the nearest dollar)', 'bookworm' ); ?>">
                        <input type="hidden" id="search-param" name="post_type" value="product" />
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3 py-2" type="submit">
                                <i class="mx-1 glph-icon flaticon-loupe text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <?php else : ?>
                <form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="form-inline my-2 my-xl-0">
                    <div class="input-group input-group-borderless w-100">
                        <div class="input-group-prepend border-right mr-0 d-none d-xl-block">
                            <?php $selected_cat = isset( $_GET['category'] ) ? $_GET['category'] : 0;
                            $navbar_search_dropdown_text = apply_filters( 'bookworm_navbar_search_category_dropdown_default_text', esc_html__( 'All Categories', 'bookworm' ) );
                            wp_dropdown_categories( apply_filters( 'bookworm_search_dropdown_categories_filter_args', array(
                                'show_option_all'   => $navbar_search_dropdown_text,
                                'taxonomy'          => 'category',
                                'hide_if_empty'     => 1,
                                'name'              => 'category',
                                'selected'          => $selected_cat,
                                'value_field'       => 'slug',
                                'id'                => 'inputGroupSelect01',
                                'class'             => 'custom-select pr-7 pl-4 rounded-right-0 height-5 shadow-none border-0 text-dark bg-gray-200'
                            ) ) );
                            ?>
                        </div>
                        <input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" class="form-control px-3 bg-gray-200 bg-focus__1" placeholder="<?php esc_attr_e( 'Search for books by keyword', 'bookworm' ); ?>" aria-label="<?php esc_attr_e( 'Amount (to the nearest dollar)', 'bookworm' ); ?>">
                        <input type="hidden" id="search-param" name="post_type" value="post" />
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3 py-2" type="submit">
                                <i class="mx-1 glph-icon flaticon-loupe text-white"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        <?php
        endif;
    }
}

if ( ! function_exists( 'bookworm_site_header_v9_offcanvas_toggle_links' ) ) {
    /**
     * Displays Offcanvas Toggler Links v9
     *
     * @return void
     */
    function bookworm_site_header_v9_offcanvas_toggle_links() {
        bookworm_site_header_offcanvas_toggle_links( 'text-secondary-black-100 font-size-2', 'text-white bg-dark', 'font-size-4 text-dark', '', 'header-icons-links');
    }
}

if ( ! function_exists( 'bookworm_site_header_v9_navbar' ) ) {
    /**
     * Displays Site Navigation Bar in Header v9
     *
     * @return void
     */
    function bookworm_site_header_v9_navbar() {
        $enable_navbar = bookworm_enable_navbar();
        if ( $enable_navbar && ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) ) ) :
            ?>
            <div class="container">
                <div class="bg-primary rounded-md d-none d-md-block">
                    <div class="d-flex align-items-center justify-content-center position-relative">
                        <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            ?><div class="site-navigation mr-auto d-none d-xl-block"><?php
                                $headerPrimaryMenuSlug = apply_filters( 'bookworm_primary_menu' , '' );
                                $primary_menu_args     = apply_filters( 'bookworm_primary_menu_args', [
                                    'theme_location'        => 'primary',
                                    'walker'                => new WP_Bootstrap_Navwalker(),
                                    'container'             => false,
                                    'menu_class'            => 'nav pl-xl-4',
                                    'nav_link_class'        => 'nav-link text-white mx-3 px-0 py-3 font-size-2 font-weight-medium',
                                    'submenu_link_class'    => 'link-black-100',
                                    'dropdown_menu_class'   => 'font-size-2',
                                ] );

                                if( ! empty( $headerPrimaryMenuSlug ) ) {
                                    $primary_menu_args['menu'] = $headerPrimaryMenuSlug;
                                }

                                wp_nav_menu( $primary_menu_args );
                            ?></div><?php
                        }

                        if ( has_nav_menu( 'secondary' ) && apply_filters( 'bookworm_enable_secondary_menu', true ) ) {
                            ?><div class="secondary-navigation"><?php
                                $headerSecondaryMenuSlug = apply_filters( 'bookworm_secondary_menu' , '' );
                                $secondary_menu_args     = apply_filters( 'bookworm_secondary_menu_args', [
                                    'theme_location'        => 'secondary',
                                    'walker'                => new WP_Bootstrap_Navwalker(),
                                    'container'             => false,
                                    'menu_class'            => 'nav pr-xl-4',
                                    'menu_item_class'       => false,
                                    'nav_link_class'        => 'nav-link text-white mx-2 px-0 py-3 font-size-2 font-weight-medium',
                                    'dropdown_menu_class'   => 'font-size-2',
                                    'depth'                 => 1,
                                ] );

                                if( ! empty( $headerSecondaryMenuSlug ) ) {
                                    $secondary_menu_args['menu'] = $headerSecondaryMenuSlug;
                                }

                                wp_nav_menu( $secondary_menu_args );
                                ?></div><?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        endif;
    }
}
