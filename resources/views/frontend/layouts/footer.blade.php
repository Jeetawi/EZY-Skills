<footer class="bg-[#0f3a73] text-white">
	<div class="max-w-7xl mx-auto px-6 py-16">
		<div class="flex flex-col md:flex-row gap-10 md:gap-20">
			<!-- Left: Logo, text, newsletter -->
			<div class="space-y-6 md:flex-1">
                <div class="flex items-center">
                    <x-frontend::application-logo type="footer" class="h-20 w-auto" />
                </div>

                <p class="text-gray-300 text-sm">
                    Let Us build your career together Be the first person to transform yourself with our unique & world class corporate level trainings.
                </p>

                <div>
					<h4 class="font-semibold underline decoration-white/20">Subscribe Our Newsletter</h4>
					<form action="#" method="POST" class="mt-4 flex w-full max-w-md">
						<input type="email" name="email" placeholder="Your Email address" class="flex-1 bg-transparent border-b border-white/20 placeholder-white/60 py-2 px-2 outline-none text-sm" />
						<button type="submit" class="ml-3 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded">&gt;</button>
					</form>
				</div>
			</div>

			<!-- Right side: Quick Links and Contact Us together -->
			<div class="flex flex-col sm:flex-row gap-10 md:gap-10 md:flex-1">
				<!-- Middle: Quick Links -->
				<div class="flex-shrink-0">
					<h4 class="text-xl font-semibold">Quick <span class="text-orange-400">Links</span></h4>
					<ul class="mt-6 space-y-3 text-white/85">
						<li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
						<li><a href="#" class="hover:underline">Our Story</a></li>
						<li><a href="{{ route('courses.index') }}" class="hover:underline">Best Courses</a></li>
						<li><a href="#" class="hover:underline">Your FAQ's</a></li>
						<li><a href="#" class="hover:underline">Cancellation & Refunds</a></li>
						<li><a href="#" class="hover:underline">Contact US</a></li>
					</ul>
				</div>

				<!-- Right: Contact Us -->
				<div class="flex-1">
					<h4 class="text-xl font-semibold">Contact <span class="text-orange-400">Us</span></h4>
					<div class="mt-6 space-y-4 text-white/90 text-sm">
						<div class="flex items-start space-x-3">
							<img src="{{ asset('images/icons/location.svg') }}" alt="Location" class="h-5 w-5 flex-shrink-0 text-orange-400 mt-0.5" />
							<div>Navakethan Complex, 6th Floor, 605, 606 A&P opp, CLock ToGet the skills you need for the future of work. Join thousands of learners advancing their careers.wer, SD Road, Secunderabad, Telangana 500003</div>
						</div>

						<div class="flex items-center space-x-3">
							<img src="{{ asset('images/icons/mail.svg') }}" alt="Email" class="h-5 w-5 text-orange-400" />
							<div>info@ezyskills.in</div>
						</div>

						<div class="flex items-start space-x-3">
							<img src="{{ asset('images/icons/phone.svg') }}" alt="Phone" class="h-5 w-5 text-orange-400" />
							<div class="text-white/80">
								<div>+91 8428448903</div>
								<div class="mt-1">+91 9475484959</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="text-sm text-white/70 flex flex-wrap justify-center md:justify-start gap-4 md:gap-6">
            <a href="#" class="hover:underline">Terms & Conditions</a>
            <a href="#" class="hover:underline">Privacy Policy</a>
        </div>
        <div class="flex items-center space-x-4 lg:pe-30 xl:pe-55">
            <a href="#" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook" class="h-4 w-4" />
            </a>
            <a href="#" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/icons/twitter.svg') }}" alt="Twitter" class="h-4 w-4" />
            </a>
            <a href="#" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/icons/instagram.svg') }}" alt="Instagram" class="h-4 w-4" />
            </a>
            <a href="#" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/icons/Linkedin.svg') }}" alt="LinkedIn" class="h-4 w-4" />
            </a>
            <a href="#" class="hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/icons/youtube.svg') }}" alt="YouTube" class="h-4 w-4" />
            </a>
        </div>
    </div>
</footer>
