<p align="center"><a href="https://billybarnyard.com" target="_blank"><svg id="The Billy Barnyard Wedding" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 501 470" width="100" height="100" class="w-20 h-20 mb-8 mx-auto"><path d="M256.2,361.23c-5.64-9.45-9.62-19.69-11.85-30.46-.71-3.42-1.24-6.9-1.58-10.4,22.18-21.65,35.96-51.89,35.96-85.33,0-8.33-.86-16.47-2.48-24.32-2.8-13.5-7.88-26.16-14.82-37.57-20.92-34.38-58.75-57.35-101.94-57.35-65.85,0-119.24,53.38-119.24,119.24s53.38,119.24,119.24,119.24c9.73,0,19.18-1.16,28.23-3.36l.09,.34c3.44,13,8.48,25.35,14.9,36.82-13.74,3.87-28.24,5.95-43.22,5.95C71.68,394.03,.5,322.85,.5,235.04S71.68,76.06,159.48,76.06c59.64,0,111.61,32.84,138.81,81.42,6.48,11.57,11.55,24.04,14.99,37.16,3.38,12.9,5.18,26.44,5.18,40.4,0,51.42-24.41,97.13-62.27,126.19Z" style="fill: gold; stroke: rgb(255, 204, 0); stroke-miterlimit: 10;"></path><path d="M318.68,153.16c7.46-1.07,15.09-1.63,22.84-1.63,87.8,0,158.98,71.18,158.98,158.98s-71.18,158.98-158.98,158.98c-59.64,0-111.61-32.84-138.81-81.42-6.42-11.47-11.47-23.82-14.9-36.82-3.44-13-5.27-26.66-5.27-40.74,0-58.6,31.7-109.79,78.89-137.36,6.94,11.41,12.02,24.07,14.82,37.57-32.5,21.3-53.96,58.04-53.96,99.8,0,8.33,.86,16.47,2.48,24.32,2.81,13.55,7.91,26.25,14.89,37.69,20.94,34.32,58.72,57.22,101.86,57.22,65.85,0,119.24-53.38,119.24-119.24s-53.38-119.24-119.24-119.24c-2.81,0-5.61,.1-8.37,.29-.17-.67-.34-1.33-.51-2-3.3-12.6-7.99-24.82-13.96-36.41Z" style="fill: gold; stroke: rgb(255, 204, 0); stroke-miterlimit: 10;"></path><polygon points="159.76 97.5 252.53 29.89 252.53 16.67 230.35 .5 159.76 .5 89.18 .5 67 16.67 67 29.89 159.76 97.5" style="fill: aqua; stroke: rgb(21, 238, 255); stroke-miterlimit: 10;"></polygon></svg></a></p>

# Billy Barnyard Wedding

## About

Since my wife was doing most of the work of planning our wedding, I decided to create our wedding website using [Laravel](https://laravel.com) instead of using one of the many wedding website services. My goal was to improve my design skills (I don't have much), show off some cool CSS animations that I wanted to learn, to learn anything I could from building this website, and to try and document a personal project as I would one at work.

This site is hosted on my Digital Ocean droplet along with my other websites.

### My Requirement for this Project

- Have a single page with all the information guests will need for the wedding. This includes the following:
  - List the venue, date, time, and accommodations
  - Have a button that links to Google maps for directions
  - Have a button that links to the hotel accommodations for easy booking
  - Have a button that links to our registry
  - Show a countdown timer until or since the wedding
  - Show our story with the major events in our relationship
- Including [Flippy Bill](https://flippy-bill.buonomo.net), a JavaScript game I created a while ago, for guests to play
- Allow guests to RSVP for themselves and others in their party
- Send notifications to guests if they want to add their email address when they RSVP
- Try to do something cool that wedding website services likely do not offer

## Security Vulnerabilities

If you discover a security vulnerability, please send an e-mail to Mike Buonomo via [mike@buonomo.net](mailto:mike@buonomo.net).

## License

Currently there is no license for this project and all rights are reserved.

## Installation

1. Clone the repository

        git clone git@github.com:mrb2590/billy-barnyard-wedding.git

2. Install composer dependencies

        composer install

2. Install npm dependencies

        npm install

2. Run locally in Docker

        ./vendor/bin/sail up
