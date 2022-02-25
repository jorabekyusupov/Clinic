INSERT INTO public.languages (id, code,"name",is_active) VALUES
	 (1, 'uz', 'O`zbekcha', 1),
	 (2, 'uzc', 'Ўзбекча', 1),
	 (3, 'ru', 'Русский', 1);

SELECT setval('languages_id_seq', max(id)) FROM public.languages;
