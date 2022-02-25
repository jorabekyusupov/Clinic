INSERT INTO public.organization_type_translations (organization_type_id,language_code,"name",description) VALUES
	 (1,'ru','Клиника','Клиника'),
	 (1,'uz','Klinika','Klinika'),
	 (1,'uzc','Клиника','Клиника'),
	 (2,'ru','Медицинский центр','Медицинский центр'),
	 (2,'uz','Tibbiyot markazi','Tibbiyot markazi'),
	 (2,'uzc','Тиббиёт маркази','Тиббиёт маркази'),
	 (3,'ru','Лаборатория','Лаборатория'),
	 (3,'uz','Laboratoriya','Laboratoriya'),
	 (3,'uzc','Лаборатория','Лаборатория');

SELECT setval('organization_type_translations_id_seq', max(id)) FROM public.organization_type_translations;
