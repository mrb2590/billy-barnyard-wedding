<p align="center"><a href="https://billybarnyard.com" target="_blank"><img src="https://raw.githubusercontent.com/mrb2590/billy-barnyard-wedding/master/resources/images/logo.svg" width="100" alt="Billy Barnyard Wedding Logo"></a></p>

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

## Local Installation

Requires Docker.

1.  Clone the repository

        git clone git@github.com:mrb2590/billy-barnyard-wedding.git

2.  Install PHP dependencies

        composer install

3.  Start container

        ./vendor/bin/sail up

4.  Install Node.js dependencies

        ./vendor/bin/sail npm install

5.  Run Locally

        ./vendor/bin/sail npm run dev

## RESTful API

See the [documentation here](https://documenter.getpostman.com/view/5647025/2s93zFYL3z).
