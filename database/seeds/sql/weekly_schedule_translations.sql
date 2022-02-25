INSERT INTO public.weekly_schedule_translations (weekly_schedule_id,language_code,"name") VALUES
	 (1,'ru','Дни работы: Понедельник-пятница, 08:00-19:00. Выходные: суббота, воскресенье '),
	 (2,'ru','Дни работы: Понедельник-суббота, 08:00-19:00. Выходные: воскресенье '),
	 (3,'ru','Дни работы: Понедельник-суббота, 08:00-18:00. Обед: 13:00-14:00. Выходные: воскресенье '),
	 (4,'ru','24 часа в сутки, 7 дней в неделю'),
	 (1,'uzc','Иш кунлари: Душанба-Жума, 08:00-19:00. Дам олиш куни: шанба, якшанба '),
	 (2,'uzc','Иш кунлари: Душанба-Жума, 08:00-19:00. Дам олиш куни: якшанба '),
	 (3,'uzc','Иш кунлари: Душанба-Шанба, 08:00-18:00. Тушлик: 13:00-14:00. Дам олиш куни: якшанба '),
	 (4,'uzc','Дам олиш кунисиз, 24 соат'),
	 (1,'uz','Ish kunlari: Dushanba-juma, 08:00-19:00. Dam olish kuni: shanba, yakshanba '),
	 (2,'uz','Ish kunlari: Dushanba-shanba, 08:00-19:00. Dam olish kuni: yakshanba '),
	 (3,'uz','Ish kunlari: Dushanba-shanba, 08:00-18:00. tushlik: 13:00-14:00. Dam olish kuni: yakshanba '),
	 (4,'uz','Dam olish kunisiz, 24 soat');

SELECT setval('weekly_schedule_translations_id_seq', max(id)) FROM public.weekly_schedule_translations;
