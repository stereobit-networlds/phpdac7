<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" >
                <li class="active"><a href="#featured" data-toggle="tab">Προσφορές</a></li>
                <li><a href="#new-arrivals" data-toggle="tab">Νέες αφίξεις</a></li>
                <li><a href="#top-sales" data-toggle="tab">Δημοφιλέστερα</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="featured">
                    <div class="product-grid-holder">		
						<phpdac>cms.callVar use fp-prosfores</phpdac>
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="javascript:filter('kfilter/ΧΑΡΤΙΑ-ΦΙΛΜ/','show-brands','','REY');">
                            <i class="fa fa-plus"></i>&nbsp;</a>
                            <!--load more products</a-->
                    </div> 

                </div>
                <div class="tab-pane" id="new-arrivals">
                    <div class="product-grid-holder">
						<phpdac>cms.callVar use fp-arrivals</phpdac>
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="javascript:filter('kfilter/ΧΑΡΤΙΑ-ΦΙΛΜ/','show-brands','','INACOPIA');">
                            <i class="fa fa-plus"></i>&nbsp;</a>
                            <!--load more products</a-->
                    </div> 

                </div>

                <div class="tab-pane" id="top-sales">
                    <div class="product-grid-holder">
						<phpdac>cms.callVar use fp-topsales</phpdac>
                    </div>
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="javascript:filter('kfilter/Μηχανήματα/','show-brands','','UNIBIND');">
                            <i class="fa fa-plus"></i>&nbsp;</a>
                            <!--load more products</a-->
                    </div> 
                </div>
            </div>
        </div>
		
    </div>
</div>