<h3>O'rnatish qadamlari</h3>

1. <code>php artisan migrate:fresh</code>
	
	DB ga table va view lar yaratadi		
	
2. <code>php artisan db:seed</code>

	Quydidagi table larni boshlang'ich ma'lumot bilan to'ldiradi:

    - Role
    - Permission
    - User
    - OrganizationType
    - Category
    - Language
    - ContentWord
    - Service
    - SpecialityType
    - Specialist
		
	Quyidagi userlarni yaratadi:
    
	- role: superadmin

	<b>Doctoradmin user</b></br>
	- username: doctoradmin, 
	- password: d0cTo1, 
	- role: doctoradmin
	
3. <code>php artisan db:fake</code>
		
	Ushbu buyruq faqat DEV envda ishlatiladi.
	DB ni Quyidagi fake ma'lumotlar bilan to'ldiradi: 

	- 50 ta organization
	- 50 ta person
	- 50 ta doctors
	- 50 ta organization services
	- 50 ta organization doctors

	
4. <code>php artisan passport:install --force</code>

	Client ID va Client secret larni generate qiladi.

Shundan so'ng username, password, client id va client secret yordamida Bearer token olish mumkin.