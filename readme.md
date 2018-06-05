## Environment Installation.
- Install PHP.
	You can install xampp for php tools.
- [Install composer on server.](https://getcomposer.org/Composer-Setup.exe)
- [Install git on server.](https://git-scm.com/download/win)
- [Download source.](https://bitbucket.org/stefanomarra-repo/linkedin-profile-scraper/src/master/)
- In the command line
	* /composer install
	* /php artisan serve
- db installation.
	* Make db leadswami on your server and import leadswami.sql file.

## Linkedin app registration.
- You can register your app in [linkedin.com](https://www.linkedin.com/developer/apps)
- In here, you have to register redirect url. ex: http://mytest.com:8000/dashboard
- When you register your app, then you can get the Client ID and Client Secret from linkedin.
	* You have to copy and paste them to .env file.
	* ex: 
	* LINKEDIN_API_KEY=817ghsoujbnznd
	* LINKEDIN_API_SECRET=QgrxQm1Dsup3D5J9
	* LINKEDIN_CALLBACK_URL=http://mytest.com:8000/dashboard
- And then you have to copy and paste your stripe key and secret to .env file.
	* ex: 
	* STRIPE_KEY=pk_test_9510pekGAiRdqBppmoFN6cR5
	* STRIPE_SECRET=sk_test_Zcxay4Kz2nO0FISBUH89Bzc8

