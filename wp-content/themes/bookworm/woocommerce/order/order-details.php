<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 8.5.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
    return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads'  => $downloads,
            'show_title' => true,
        )
    );
}
?>
<section class="woocommerce-order-details">
    <?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

    <h2 class="woocommerce-order-details__title font-size-3 font-weight-medium mb-4 pb-1 px-3 px-md-5"><?php esc_html_e( 'Order details', 'bookworm' ); ?></h2>

    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details d-block">

        <thead class="sr-only">
            <tr>
                <th class="woocommerce-table__product-name product-name"><?php esc_html_e( 'Product', 'bookworm' ); ?></th>
                <th class="woocommerce-table__product-table product-total"><?php esc_html_e( 'Total', 'bookworm' ); ?></th>
            </tr>
        </thead>

        <tbody class="border-bottom mb-5 pb-6 px-3 px-md-5 d-block">
            <?php
            do_action( 'woocommerce_order_details_before_order_table_items', $order );

            foreach ( $order_items as $item_id => $item ) {
                $product = $item->get_product();

                wc_get_template(
                    'order/order-details-item.php',
                    array(
                        'order'              => $order,
                        'item_id'            => $item_id,
                        'item'               => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note'      => $product ? $product->get_purchase_note() : '',
                        'product'            => $product,
                    )
                );
            }

            do_action( 'woocommerce_order_details_after_order_table_items', $order );
            ?>
        </tbody>

        <tbody class="border-bottom mb-5 pb-6 px-3 px-md-5 d-block">
            <?php
            $order_item_totals = $order->get_order_item_totals();
            foreach ( $order_item_totals as $key => $total ) {
                if ( $key === 'order_total' ) continue;
                ?>
                    <tr class="d-flex justify-content-between py-2">
                        <th class="font-weight-medium font-size-2 p-0" scope="row"><?php echo esc_html( $total['label'] ); ?></th>
                        <td class="font-weight-medium font-size-2 p-0 <?php echo esc_attr( $key );?>"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                    </tr>
                    <?php
            }
            ?>
            <?php if ( $order->get_customer_note() ) : ?>
                <tr class="d-flex justify-content-between py-2">
                    <th class="font-weight-medium font-size-2 d-block p-0"><?php esc_html_e( 'Note:', 'bookworm' ); ?></th>
                    <td class="font-weight-medium font-size-2 text-muted d-block p-0"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>

        <tfoot class="border-bottom pb-5 px-3 px-md-5 d-block">
            <?php
            if ( isset( $order_item_totals[ 'order_total'] ) ) {
                $total = $order_item_totals['order_total'];
                ?>
                    <tr class="d-flex justify-content-between align-items-center">
                        <th class="font-weight-medium font-size-2 p-0" scope="row"><?php echo esc_html( $total['label'] ); ?></th>
                        <td class="font-weight-medium font-size-3 p-0"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                    </tr>
                <?php
            }
            ?>
        </tfoot>
    </table>

    <?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

</section>

<?php
if ( $show_customer_details ) {
    wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
