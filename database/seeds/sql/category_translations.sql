INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (1,'ru','Аллерголог'),
	 (2,'ru','АиГ'),
	 (3,'ru','Анестезия'),
	 (4,'ru','Гастроэнтеролог'),
	 (5,'ru','Гематология'),
	 (6,'ru','Генетика'),
	 (7,'ru','Гериатрия'),
	 (8,'ru','Дерматология'),
	 (9,'ru','Детская онко'),
	 (10,'ru','Детская хирургия');
INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (11,'ru','Диабетология'),
	 (12,'ru','Диетология'),
	 (13,'ru','Инфекция'),
	 (14,'ru','Кардиология'),
	 (15,'ru','КлинЛабДиагностика'),
	 (16,'ru','КлинФармакология'),
	 (17,'ru','Колопроктология'),
	 (18,'ru','ЛабГенетика'),
	 (19,'ru','ЛечФизкультура'),
	 (20,'ru','Соцгигиена');
INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (21,'ru','МанТерапия'),
	 (22,'ru','Неврология'),
	 (23,'ru','Нейрохирургия'),
	 (24,'ru','Нефрология'),
	 (25,'ru','ВОП'),
	 (26,'ru','Онкология'),
	 (27,'ru','ЛОР'),
	 (28,'ru','Офтальмология'),
	 (29,'ru','ПатАнатомия'),
	 (30,'ru','Педиатрия');
INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (31,'ru','Неонатология'),
	 (32,'ru','Профпатология'),
	 (33,'ru','Психотерапия'),
	 (34,'ru','Психиатрия'),
	 (35,'ru','ПсихНаркология'),
	 (36,'ru','Пульмонология'),
	 (37,'ru','РадиологияТерапия'),
	 (38,'ru','Рентгенология'),
	 (39,'ru','Ревматология'),
	 (40,'ru','Сексология');
INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (41,'ru','СердСосудХирРЭХ'),
	 (42,'ru','СкораяМедПомощь'),
	 (43,'ru','СудМедЭкспертиза'),
	 (44,'ru','СурдологияЛОР'),
	 (45,'ru','Терапия'),
	 (46,'ru','Токсикология'),
	 (47,'ru','ТоракХирургия'),
	 (48,'ru','ТравматологияОртопедия'),
	 (49,'ru','Трансфузиология'),
	 (50,'ru','УЗИ');
INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (51,'ru','УрологияАндрология'),
	 (52,'ru','Физиотерапия'),
	 (53,'ru','Фтизиатрия'),
	 (54,'ru','ФункцДиагностика'),
	 (55,'ru','ХирургияТрансплантология'),
	 (56,'ru','Эндокринология'),
	 (57,'ru','Эндоскопия'),
	 (58,'ru','Ортодонтия'),
	 (59,'ru','Стоматология'),
	 (60,'ru','СтоматологияТерапевт');
INSERT INTO public.category_translations (category_id,language_code,"name") VALUES
	 (61,'ru','СтоматологияХир'),
	 (62,'ru','ЧелЛицХирургия'),
	 (63,'ru','Прочее'),
	 (64,'ru','Без категории');

SELECT setval('category_translations_id_seq', max(id)) FROM public.category_translations;
