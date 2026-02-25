<?php
// credit-card-hero uses acf_register_block_type with render_template (not render_callback),
// so it still needs its own registration — but nothing else is unique here.
// NOTE: registration is handled via functions.php > register_credit_card_blocks().
// Once that is moved to index.php, this file can be removed entirely or kept
// as a placeholder for future block-specific logic.