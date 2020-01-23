/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./components/Example');

// Custom Code

// Fade alerts
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

// Checkbox select/deselect
( function( $ ) {

    $.fn.multicheck = function( $checkboxes ) {
        $checkboxes = $checkboxes.filter( 'input[type=checkbox]' );
        if( $checkboxes.length > 0 ) {
            this.each( function() {
                var $this = $( this );
                $this.click( function() {
                    $checkboxes.prop( 'checked', this.checked );
                    $this.trigger( this.checked ? 'multicheck.allchecked' : 'multicheck.nonechecked' );
                });
                $checkboxes.on( 'click change', function() {
                    var checkedItems = $checkboxes.filter( ':checked' ).length;
                    if( checkedItems == 0 ) {
                        $this[ 0 ].indeterminate = false;
                        $this[ 0 ].checked = false;
                        $this.trigger( 'multicheck.nonechecked' );
                    } else if( checkedItems == $checkboxes.length ) {
                        $this[ 0 ].indeterminate = false;
                        $this[ 0 ].checked = true;
                        $this.trigger( 'multicheck.allchecked' );
                    } else {
                        $this[ 0 ].checked = false;
                        $this[ 0 ].indeterminate = true;
                        $this.trigger( 'multicheck.somechecked' );
                    }
                });
            });
        }
        return this;
    };

})( jQuery );

// Initialise Popper
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
