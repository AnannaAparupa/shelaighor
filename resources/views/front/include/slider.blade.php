<div id="shopify-section-1522137250609" class="shopify-section wpbFramework">
    <div class="wpbSlideshow wpbBlock ">
        <div data-section-id="1522137250609" data-section-type="wpbSlideshowSection">

            <div class="wpbSlideshowWrapper">
                <button type="button" class="hidden btnssPause" data-id="1522137250609">
                          <span class="btnssPauseStop">
                              <i class="fa fa-play"></i>
                              <span class="iconText">Pause slideshow</span>
                          </span>
                    <span class="btnssPausePlay">
                              <i class="fa fa-pause"></i>
                              <span class="iconText">Play slideshow</span>
                          </span>
                </button>
                <div id="wpbSlideshows1522137250609" class="slideshow"
                     data-autoplay="true"
                     data-speed="7000">
                    @foreach($sliders as $slider)
                    <div class="wpbssSlide  wpbssSlide1523849584102" >


                        <div class="wpbssImage" data-image="{{ Voyager::image($slider->image) }}">

                            <img class="img-responsive" alt="Sheli Ghor" src="{{ Voyager::image($slider->image) }}" />

                        </div>
                        <div class="wpbssCaption caption-left">
                            <div class="wpbssCaptionContent">
                                <div class="container">
                                    <div class="wpbssCaptionInner">
                                        <div class="sliderCaption">


                                            <h2 class="slideTitle leftright-2" style="color:#ffffff;">
                                                {{ $slider->headeing_one }}
                                            </h2>


                                            <h3 class="slideTitle1 leftright-3" style="color:#ffffff;">
                                                <span class="line-slider" style="background-color:#ffffff;"></span>
                                                {{ $slider->headeing_two }}
                                            </h3>

                                        </div>

                                        <div class="slideDesc caption-left leftright-4" style="color:#ffffff;">
                                            {{ $slider->paragraph }}
                                        </div>


                                        <div class="slideBtn caption-left">
                                            <a class="btn btnWpbingoSlider btnWhite bottomtop-1" href="{{ url('/shop') }}">purchase</a>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                        @endforeach


                </div>
            </div>


        </div>
    </div>
</div>