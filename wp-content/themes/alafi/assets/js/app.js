(function ($) {
  'use strict';

  $(document).on('click', '.alafi-pincode-btn', function () {
    const pincode = $('#alafi-pincode').val();
    $('[data-pincode-result]').text('Checking...').addClass('alafi-skeleton');

    fetch(`${alafiConfig.restUrl}/pincode-serviceability?pincode=${encodeURIComponent(pincode)}`)
      .then((response) => response.json())
      .then((payload) => {
        const label = payload.serviceable ? 'Delivery available.' : 'Currently unavailable.';
        $('[data-pincode-result]').text(label).removeClass('alafi-skeleton');
      });
  });

  $(document).on('click', '[data-wishlist-toggle]', function () {
    const productId = $(this).data('wishlist-toggle');

    $.post(alafiConfig.ajaxUrl, {
      action: 'alafi_wishlist_toggle',
      nonce: alafiConfig.ajaxNonce,
      product_id: productId
    });
  });
})(jQuery);
