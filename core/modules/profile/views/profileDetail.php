<div class="gradient" id="titlebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $company; ?></h1>
                <p class="address"><i class="fa fa-map-marker"></i> <?php echo $meta['address']; ?></p>
                <div class="logo"><img src="<?php echo getFileUrl($avatar); ?>"></div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="company-details">
            <h3>Company Info</h3>
            <div class="row">
                <div class="col-md-3"> <i class="fa fa-play-circle-o"></i>Established <br> <strong><?php echo $meta['est']; ?></strong></div>
                <div class="col-md-3"><i class="fa fa-play-circle-o"></i>Contact No <br> <strong><?php echo $phone; ?></strong></div>
                <div class="col-md-3"><i class="fa fa-play-circle-o"></i>Email <br> <strong><?php echo $email; ?></strong></div>
                <div class="col-md-3"><i class="fa fa-play-circle-o"></i>Website <br> <strong>Visit: <?php echo $meta['website']; ?></strong></div>
            </div>
            <div class="row">
                <div class="col-md-3"><i class="fa fa-play-circle-o"></i>Company Size <br> <strong><?php echo $meta['team_size']; ?></strong></div>
                <div class="col-md-3"><i class="fa fa-play-circle-o"></i>Ownership <br> <strong><?php echo $meta['ownership']; ?></strong></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="about-company">
            <h3>About Company</h3>
            <div class="">
                <div class="description">
                    <?php echo $bio; ?>
                </div>
                <div id="mapid"></div>

            </div>
            
        </div>
        
    </div>
    
</div>

<script>

var map = L.map('mapid').setView([<?php echo $coordinate['lat']; ?>, <?php echo $coordinate['lng']; ?>], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.tileLayer.provider('OpenMapSurfer.Roads').addTo(map);

L.marker([<?php echo $coordinate['lat']; ?>, <?php echo $coordinate['lng']; ?>]).addTo(map)
    .bindPopup('<?php echo $company; ?>')
    .openPopup();
</script>