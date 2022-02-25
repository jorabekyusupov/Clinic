CREATE OR REPLACE VIEW public.view_content_words
AS SELECT cw.id,
    cw.word,
    cw.status,
    cw.created_by,
    cw.created_at,
    cw.updated_by,
    cw.updated_at,
    cw.deleted_at,
    cw.deleted_by,
    cwt.id AS content_word_translation_id,
    cwt.content_word_id,
    cwt.language_code,
    cwt.translation
   FROM content_words cw
     LEFT JOIN content_word_translations cwt ON cw.id = cwt.content_word_id;