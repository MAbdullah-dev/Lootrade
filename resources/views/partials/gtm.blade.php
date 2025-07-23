<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MZS9B6DK');</script>
<!-- End Google Tag Manager -->


<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MZS9B6DK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
            document.addEventListener('livewire:navigated', () => {
            console.log("✅ livewire:navigated triggered");
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: "page_view",
                page_path: window.location.pathname,
                page_location: window.location.href,
                page_title: document.title
            });
            console.log("✅ GTM page_view pushed to dataLayer");
        });
</script>
