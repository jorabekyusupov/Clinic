INSERT INTO public.specialty_types (id,"type",created_by,created_at) VALUES
	 (13,0,1,NOW()),
	 (14,0,1,NOW()),
	 (15,0,1,NOW()),
	 (16,0,1,NOW()),
	 (17,1,1,NOW()),
	 (18,1,1,NOW()),
	 (19,1,1,NOW()),
	 (20,1,1,NOW());

SELECT setval('specialty_types_id_seq', max(id)) FROM public.specialty_types;
