<?php

/*
 * Copyright (C) 2014 salokine
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Attribut contenteditable
 * Supported: HTML 5
 * Specifies whether the content of an element is editable or not
 * @link http://www.w3schools.com/tags/att_global_contenteditable.asp Documentation
 * @author Boris Sanègre <boris.sanegre@ldc.fr>
 * @license see LICENSE.TXT at the root of this project
 */
class AttributeContentEditable extends AbstractAttributeTypeTrueFalse {

    const NAME = "contenteditable";

    public function getName() {
        return self::NAME;
    }

}
