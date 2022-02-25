INSERT INTO public.organization_types (created_by,created_at) VALUES
	 (1,NOW()),
	 (1,NOW()),
	 (1,NOW());

SELECT setval('organization_types_id_seq', max(id)) FROM public.organization_types;
