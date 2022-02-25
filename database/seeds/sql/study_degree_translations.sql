INSERT INTO public.study_degree_translations (study_degree_id,language_code,"name") VALUES
	 (1,'ru','Средний'),
	 (2,'ru','Средний специальный'),
	 (3,'ru','Бакалавр'),
	 (4,'ru','Магистр'),
	 (5,'ru','Аспирантура'),
	 (6,'ru','Докторантура'),
	 (7,'ru','Клинические ординатура'),
	 (1,'uzc','Ўрта'),
	 (2,'uzc','Ўрта махсус'),
	 (3,'uzc','Бакалавр'),
	 (4,'uzc','Магистр'),
	 (5,'uzc','Аспирантура'),
	 (6,'uzc','Докторантура'),
	 (7,'uzc','Клиник ординатура'),
	 (1,'uz','O`rta'),
	 (2,'uz','O`rta maxsus'),
	 (3,'uz','Bakalavr'),
	 (4,'uz','Magistr'),
	 (5,'uz','Aspirantura'),
	 (6,'uz','Doktorantura'),
	 (7,'uz','Klinik ordinatura');

SELECT setval('study_degree_translations_id_seq', max(id)) FROM public.study_degree_translations;
