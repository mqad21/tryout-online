		<!-- jquery Min JS -->
		<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
		<!-- jquery Migrate JS -->
		<script src="{{ asset('assets/js/jquery-migrate-3.0.0.js') }}"></script>
		<!-- jquery Ui JS -->
		<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
		<!-- Easing JS -->
		<script src="{{ asset('assets/js/easing.js') }}"></script>
		<!-- Color JS -->
		<script src="{{ asset('assets/js/colors.js') }}"></script>
		<!-- Popper JS -->
		<script src="{{ asset('assets/js/popper.min.js') }}"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
		<!-- Jquery Nav JS -->
		<script src="{{ asset('assets/js/jquery.nav.js') }}"></script>
		<!-- Slicknav JS -->
		<script src="{{ asset('assets/js/slicknav.min.js') }}"></script>
		<!-- ScrollUp JS -->
		<script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
		<!-- Niceselect JS -->
		<script src="{{ asset('assets/js/niceselect.js') }}"></script>
		<!-- Tilt Jquery JS -->
		<script src="{{ asset('assets/js/tilt.jquery.min.js') }}"></script>
		<!-- Owl Carousel JS -->
		<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
		<!-- counterup JS -->
		<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
		<!-- Steller JS -->
		<script src="{{ asset('assets/js/steller.js') }}"></script>
		<!-- Wow JS -->
		<script src="{{ asset('assets/js/wow.min.js') }}"></script>
		<!-- Magnific Popup JS -->
		<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
		<!-- Counter Up CDN JS -->
		<script src="{{ asset('assets/http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js') }}"></script>
		<!-- Bootstrap JS -->
		<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		<!-- Main JS -->
		<script src="{{ asset('assets/js/main.js') }}"></script>

		<script>
		    $(document).ready(function() {
		        $('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
		            var src = $(this).attr('src');
		            var modal;

		            function removeModal() {
		                modal.remove();
		                $('body').off('keyup.modal-close');
		            }
		            modal = $('<div>').css({
		                background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
		                backgroundSize: 'contain',
		                width: '100%',
		                height: '100%',
		                position: 'fixed',
		                zIndex: '10000',
		                top: '0',
		                left: '0',
		                cursor: 'zoom-out'
		            }).click(function() {
		                removeModal();
		            }).appendTo('body');
		            //handling ESC
		            $('body').on('keyup.modal-close', function(e) {
		                if (e.key === 'Escape') {
		                    removeModal();
		                }
		            });
		        });
		    });

		    function createPopupWin(pageURL, pageTitle,
		        popupWinWidth, popupWinHeight) {
		        var left = (screen.width - popupWinWidth) / 2;
		        var top = (screen.height - popupWinHeight) / 4;

		        var myWindow = window.open(pageURL, pageTitle,
		            'resizable=yes, width=' + popupWinWidth +
		            ', height=' + popupWinHeight + ', top=' +
		            top + ', left=' + left);
		    }
		</script>

		@yield('script')
		</body>

		</html>