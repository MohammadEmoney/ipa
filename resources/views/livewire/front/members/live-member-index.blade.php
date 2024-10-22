<div>
    <livewire:front.components.live-breadcrumb 
      :title="$title"
      :items="[['title' => __('global.home'), 'route' => route('home')], ['title' => $title]]" 
    />
    
        <!-- ======= Our Team Section ======= -->
        <section id="team" class="team">
            <div class="container" data-aos="fade-up">
      
              <div class="section-header">
                <h2>{{ $title }}</h2>
                <p>{!! $settings['team_member_description'] ?? "" !!}</p>
              </div>
      
              <div class="row gy-4">
      
                @foreach ($members as $member)    
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <img src="{{ $member->getFirstMediaUrl('avatar') }}" class="img-fluid" alt="{{ $member->full_name }}">
                        <h4>{{ $member->full_name }}</h4>
                        <span>{{ $member->title }}</span>
                        <div class="social">
                            @foreach ($member->social ?? "" as $social)
                                <a href="{{ $social['link'] }}" target="_blank"><i class="bi bi-{{ $social['social'] }}"></i></a>
                            @endforeach
                        {{-- <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a> --}}
                        </div>
                    </div>
                    </div><!-- End Team Member -->
                @endforeach
{{--       
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                  <div class="member">
                    <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                    <h4>Sarah Jhinson</h4>
                    <span>Marketing</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div><!-- End Team Member -->
      
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                  <div class="member">
                    <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                    <h4>William Anderson</h4>
                    <span>Content</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div><!-- End Team Member -->
      
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                  <div class="member">
                    <img src="assets/img/team/team-4.jpg" class="img-fluid" alt="">
                    <h4>Amanda Jepson</h4>
                    <span>Accountant</span>
                    <div class="social">
                      <a href=""><i class="bi bi-twitter"></i></a>
                      <a href=""><i class="bi bi-facebook"></i></a>
                      <a href=""><i class="bi bi-instagram"></i></a>
                      <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                  </div>
                </div><!-- End Team Member --> --}}
      
              </div>
      
            </div>
        </section><!-- End Our Team Section -->
  </div>
  