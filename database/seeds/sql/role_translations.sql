INSERT INTO public.role_translations (role_id,language_code,display_name,description) VALUES

	 (1,'ru','Суперадмин','Суперадмин'),
	 (1,'uz','Superadmin','Superadmin'),
	 (1,'uzc','Суперадмин','Суперадмин'),

	 (2,'ru','Доктор админ','Доктор админ'),
	 (2,'uz','Doktor admin','Doktor admin'),
	 (2,'uzc','Доктор админ','Доктор админ');

SELECT setval('role_translations_id_seq', max(id)) FROM public.role_translations;
