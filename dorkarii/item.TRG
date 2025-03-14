TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER increment_items_used\nAFTER INSERT ON Item\nFOR EACH ROW\nBEGIN\n    UPDATE Food\n    SET no_of_items_used = no_of_items_used + 1\n    WHERE food_name = NEW.food_name;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER decrement_items_used\nAFTER DELETE ON Item\nFOR EACH ROW\nBEGIN\n    UPDATE Food\n    SET no_of_items_used = GREATEST(no_of_items_used - 1, 0)\n    WHERE food_name = OLD.food_name;\nEND'
sql_modes=1098907648 1098907648
definers='root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_unicode_ci' 'utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci'
created=1741969141362931 1741969173302962
