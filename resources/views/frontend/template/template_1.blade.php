@include("frontend.template._head")

<body id="kt_body" style="background-image: url('{{ asset('assets/media/patterns/header-bg.jpg') }}')" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="bg-white position-relative">


	
	@if ($showThings['_show_HEADER'])
	
    	@include("frontend.template.individual_sections._header")
                
	@endif
    
    
    @include("frontend.template._show_messages")
	@include($_pageview)
	
    



    @include("frontend.template._includes_footer")

    
    
</body>
</html>