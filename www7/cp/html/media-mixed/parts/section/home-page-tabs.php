<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" >
                <li class="active"><a href="#featured" data-toggle="tab"><phpdac>cmsrt.slocale use _fpprosfores</phpdac></a></li>
                <li><a href="#new-arrivals" data-toggle="tab"><phpdac>cmsrt.slocale use _fpnewarrivals</phpdac></a></li>
                <li><a href="#top-sales" data-toggle="tab"><phpdac>cmsrt.slocale use _fptopsales</phpdac></a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="featured">

                    <div class="product-grid-holder">		
                       <div class="row no-margin">
						<phpdac>cms.callVar use fp-prosfores</phpdac>
					    </div>
					    
                       <div class="row no-margin">
						<phpdac>cms.callVar use fp-prosfores2</phpdac>
					    </div>					    
                    </div>

                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="#">
                            <i class="fa fa-plus"></i>&nbsp;</a>
                    </div> 

                </div>
                <div class="tab-pane" id="new-arrivals">
                    <div class="product-grid-holder">		
                       <div class="row no-margin">
						<phpdac>cms.callVar use fp-arrivals</phpdac>
					    </div>
					    
                       <div class="row no-margin">
						<phpdac>cms.callVar use fp-arrivals2</phpdac>
					    </div>					    
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="#">
                            <i class="fa fa-plus"></i>&nbsp;</a>
                    </div> 

                </div>

                <div class="tab-pane" id="top-sales">
                    <div class="product-grid-holder">		
                       <div class="row no-margin">
						<phpdac>cms.callVar use fp-topsales</phpdac>
					    </div>
					    
                       <div class="row no-margin">
						<phpdac>cms.callVar use fp-topsales2</phpdac>
					    </div>					    
                    </div>>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="#">
                            <i class="fa fa-plus"></i>&nbsp;</a>
                    </div> 
                </div>
            </div>
        </div>
		
    </div>
</div>