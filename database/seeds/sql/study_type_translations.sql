INSERT INTO public.study_type_translations (study_type_id,language_code,"name") VALUES
	 (1,'ru','Очное'),
	 (2,'ru','Заочное'),
	 (3,'ru','Дистанционное'),
	 (1,'uzc','Кундузги'),
	 (2,'uzc','Сиртқи'),
	 (3,'uzc','Масофавий'),
	 (1,'uz','Kunduzgi'),
	 (2,'uz','Sirtqi'),
	 (3,'uz','Masofaviy');

SELECT setval('study_type_translations_id_seq', max(id)) FROM public.study_type_translations;
