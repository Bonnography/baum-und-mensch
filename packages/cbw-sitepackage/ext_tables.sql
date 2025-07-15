#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content
(
    tx_inline_item int(11) unsigned DEFAULT '0',
    inline_layout  int(11) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'tx_inline_item'
#
CREATE TABLE tx_inline_item
(
    uid               int(11) NOT NULL auto_increment,
    pid               int(11) DEFAULT '0' NOT NULL,
    tt_content        int(11) unsigned DEFAULT '0',
    item_type         varchar(255)  DEFAULT '' NOT NULL,
    size              varchar(3)    DEFAULT '' NOT NULL,
    header            varchar(255)  DEFAULT '' NOT NULL,
    subheader         varchar(255)  DEFAULT '' NOT NULL,
    header_layout     varchar(30)   DEFAULT '' NOT NULL,
    header_style      varchar(30)   DEFAULT '' NOT NULL,
    header_link       varchar(1024) DEFAULT '' NOT NULL,
    bodytext          text,
    image             int(11) unsigned DEFAULT '0' NOT NULL,
    image_position    int(11) unsigned DEFAULT '0' NOT NULL,
    remove_cta_button int(11) unsigned DEFAULT '0' NOT NULL,
    cta               varchar(255)  DEFAULT '' NOT NULL,
    cta_text          text,

    PRIMARY KEY (uid),
    KEY               tt_content (tt_content),
    KEY               parent(pid),
);