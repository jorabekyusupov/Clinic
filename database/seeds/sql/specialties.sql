insert into public.specialties(id,specialty_type_id,created_by,created_at) values
(1,13,1,NOW()),
(2,13,1,NOW()),
(3,13,1,NOW()),
(4,13,1,NOW()),
(5,13,1,NOW()),
(6,13,1,NOW()),
(7,13,1,NOW()),
(8,13,1,NOW()),
(9,13,1,NOW()),
(10,13,1,NOW()),
(11,13,1,NOW()),
(12,13,1,NOW()),
(13,13,1,NOW()),
(14,13,1,NOW()),
(15,13,1,NOW()),
(16,13,1,NOW()),
(17,13,1,NOW()),
(18,13,1,NOW()),
(19,13,1,NOW()),
(20,13,1,NOW()),
(21,13,1,NOW()),
(22,13,1,NOW()),
(23,13,1,NOW()),
(24,13,1,NOW()),
(25,13,1,NOW()),
(26,13,1,NOW()),
(27,13,1,NOW()),
(28,13,1,NOW()),
(29,13,1,NOW()),
(30,13,1,NOW()),
(31,14,1,NOW()),
(32,14,1,NOW()),
(33,14,1,NOW()),
(34,14,1,NOW()),
(35,14,1,NOW()),
(36,15,1,NOW()),
(37,15,1,NOW()),
(38,15,1,NOW()),
(39,15,1,NOW()),
(40,16,1,NOW()),
(41,16,1,NOW()),
(42,16,1,NOW()),
(43,16,1,NOW()),
(44,16,1,NOW()),
(45,16,1,NOW()),
(46,17,1,NOW()),
(47,17,1,NOW()),
(48,17,1,NOW()),
(49,17,1,NOW()),
(50,17,1,NOW()),
(51,17,1,NOW()),
(52,17,1,NOW()),
(53,17,1,NOW()),
(54,17,1,NOW()),
(55,17,1,NOW()),
(56,17,1,NOW()),
(57,17,1,NOW()),
(58,17,1,NOW()),
(59,17,1,NOW()),
(60,17,1,NOW()),
(61,17,1,NOW()),
(62,17,1,NOW()),
(63,17,1,NOW()),
(64,17,1,NOW()),
(65,17,1,NOW()),
(66,17,1,NOW()),
(67,17,1,NOW()),
(68,17,1,NOW()),
(69,17,1,NOW()),
(70,17,1,NOW()),
(71,17,1,NOW()),
(72,17,1,NOW()),
(73,17,1,NOW()),
(74,17,1,NOW()),
(75,17,1,NOW()),
(76,17,1,NOW()),
(77,17,1,NOW()),
(78,17,1,NOW()),
(79,17,1,NOW()),
(80,17,1,NOW()),
(81,17,1,NOW()),
(82,17,1,NOW()),
(83,17,1,NOW()),
(84,17,1,NOW()),
(85,17,1,NOW()),
(86,17,1,NOW()),
(87,17,1,NOW()),
(88,17,1,NOW()),
(89,17,1,NOW()),
(90,17,1,NOW()),
(91,17,1,NOW()),
(92,17,1,NOW()),
(93,17,1,NOW()),
(94,17,1,NOW()),
(95,17,1,NOW()),
(96,17,1,NOW()),
(97,17,1,NOW()),
(98,17,1,NOW()),
(99,17,1,NOW()),
(100,17,1,NOW()),
(101,17,1,NOW()),
(102,17,1,NOW()),
(103,17,1,NOW()),
(104,17,1,NOW()),
(105,17,1,NOW()),
(106,17,1,NOW()),
(107,17,1,NOW()),
(108,17,1,NOW()),
(109,17,1,NOW()),
(110,17,1,NOW()),
(111,17,1,NOW()),
(112,17,1,NOW()),
(113,17,1,NOW()),
(114,17,1,NOW()),
(115,17,1,NOW()),
(116,17,1,NOW()),
(117,17,1,NOW()),
(118,17,1,NOW()),
(119,17,1,NOW()),
(120,17,1,NOW()),
(121,17,1,NOW()),
(122,17,1,NOW()),
(123,17,1,NOW()),
(124,17,1,NOW()),
(125,17,1,NOW()),
(126,18,1,NOW()),
(127,18,1,NOW()),
(128,18,1,NOW()),
(129,18,1,NOW()),
(130,18,1,NOW()),
(131,18,1,NOW()),
(132,18,1,NOW()),
(133,18,1,NOW()),
(134,18,1,NOW()),
(135,18,1,NOW()),
(136,18,1,NOW()),
(137,18,1,NOW()),
(138,18,1,NOW()),
(139,19,1,NOW()),
(140,19,1,NOW()),
(141,19,1,NOW()),
(142,19,1,NOW()),
(143,19,1,NOW()),
(144,19,1,NOW()),
(145,19,1,NOW()),
(146,19,1,NOW()),
(147,19,1,NOW()),
(148,19,1,NOW()),
(149,19,1,NOW()),
(150,19,1,NOW()),
(151,19,1,NOW()),
(152,19,1,NOW()),
(153,20,1,NOW()),
(154,20,1,NOW());

SELECT setval('specialties_id_seq', max(id)) FROM public.specialties;
