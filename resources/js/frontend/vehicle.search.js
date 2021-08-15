/*
// .block-finder
*/
$(function () {
    $('.block-finder__form-control--select select').on('change', function() {
        const item = $(this).closest('.block-finder__form-control--select');

        if ($(this).val() !== 'none') {
            item.find('~ .block-finder__form-control--select:eq(0) select').prop('disabled', false).val('none');
            item.find('~ .block-finder__form-control--select:gt(0) select').prop('disabled', true).val('none');
        } else {
            item.find('~ .block-finder__form-control--select select').prop('disabled', true).val('none');
        }

        item.find('~ .block-finder__form-control--select select').trigger('change.select2');
    });
});

// /*
// // select2
// */
// $(function () {
//     $('.form-control-select2, .block-finder__form-control--select select').select2({width: ''});
// });
