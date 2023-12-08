<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2013 The Open University UK                                   *
 *                                                                              *
 *  This software is freely distributed in accordance with                      *
 *  the GNU Lesser General Public (LGPL) license, version 3 or later            *
 *  as published by the Free Software Foundation.                               *
 *  For details see LGPL: http://www.fsf.org/licensing/licenses/lgpl.html       *
 *               and GPL: http://www.fsf.org/licensing/licenses/gpl-3.0.html    *
 *                                                                              *
 *  This software is provided by the copyright holders and contributors "as is" *
 *  and any express or implied warranties, including, but not limited to, the   *
 *  implied warranties of merchantability and fitness for a particular purpose  *
 *  are disclaimed. In no event shall the copyright owner or contributors be    *
 *  liable for any direct, indirect, incidental, special, exemplary, or         *
 *  consequential damages (including, but not limited to, procurement of        *
 *  substitute goods or services; loss of use, data, or profits; or business    *
 *  interruption) however caused and on any theory of liability, whether in     *
 *  contract, strict liability, or tort (including negligence or otherwise)     *
 *  arising in any way out of the use of this software, even if advised of the  *
 *  possibility of such damage.                                                 *
 *                                                                              *
 ********************************************************************************/

define('COHERE_NS', 'http://cohere.open.ac.uk/ontology/cohere.owl#');

class COHERE_RES {

	function SET() {
		return new ResResource(COHERE_NS . 'set');
	}

	function ABSTRACT_IDEA()
	{
		return new ResResource(COHERE_NS . 'abstract_idea');
	}

	function ROLE()
	{
		return new ResResource(COHERE_NS . 'role');
	}

	function ABSTRACT_OBJECT()
	{
		return new ResResource(COHERE_NS . 'abstract_object');
	}

	function CONNECTION_LABEL()
	{
		return new ResResource(COHERE_NS . 'connection_label');
	}

	function NODE()
	{
		return new ResResource(COHERE_NS . 'node');
	}

	function DOCUMENT()
	{
		return new ResResource(COHERE_NS . 'document');
	}

	function COHERE_THING()
	{
		return new ResResource(COHERE_NS . 'cohere_thing');
	}

	function COHERE_USER()
	{
		return new ResResource(COHERE_NS . 'cohere_user');
	}

	function CONNECTION_LABEL_ROLE()
	{
		return new ResResource(COHERE_NS . 'connection_label_role');
	}

	function IMAGE()
	{
		return new ResResource(COHERE_NS . 'image');
	}

	function WEBSITE()
	{
		return new ResResource(COHERE_NS . 'website');
	}

	function CONNECTION_NODE_ROLE()
	{
		return new ResResource(COHERE_NS . 'connection_node_role');
	}

	function CONNECTION()
	{
		return new ResResource(COHERE_NS . 'connection');
	}

	function HAS_DEPICTION()
	{
		return new ResResource(COHERE_NS . 'has_depiction');
	}

	function HAS_SCREENSHOT()
	{
		return new ResResource(COHERE_NS . 'has_screenshot');
	}

	function INCLUDES_IDEA()
	{
		return new ResResource(COHERE_NS . 'includes_idea');
	}

	function HAS_THUMBNAIL()
	{
		return new ResResource(COHERE_NS . 'has_thumbnail');
	}

	function HAS_WEBSITE()
	{
		return new ResResource(COHERE_NS . 'has_website');
	}

	function HAS_HOMEPAGE()
	{
		return new ResResource(COHERE_NS . 'has_homepage');
	}

	function HAS_TO_NODE_ROLE()
	{
		return new ResResource(COHERE_NS . 'has_to_node_role');
	}

	function HAS_THUMBNAIL_IMAGE()
	{
		return new ResResource(COHERE_NS . 'has_thumbnail_image');
	}

	function HAS_IMAGE()
	{
		return new ResResource(COHERE_NS . 'has_image');
	}

	function HAS_FROM_NODE_ROLE()
	{
		return new ResResource(COHERE_NS . 'has_from_node_role');
	}

	function HAS_EMAIL_ADDRESS()
	{
		return new ResResource(COHERE_NS . 'has_email_address');
	}

	function HAS_MODIFICATION_DATE()
	{
		return new ResResource(COHERE_NS . 'has_modification_date');
	}

	function HAS_CREATOR()
	{
		return new ResResource(COHERE_NS . 'has_creator');
	}

	function HAS_LABEL_ROLE()
	{
		return new ResResource(COHERE_NS . 'has_label_role');
	}

	function HAS_URL()
	{
		return new ResResource(COHERE_NS . 'has_url');
	}

	function HAS_LABEL()
	{
		return new ResResource(COHERE_NS . 'has_label');
	}


	function HAS_FROM_NODE()
	{
		return new ResResource(COHERE_NS . 'has_from_node');
	}

	function HAS_CREATION_DATE()
	{
		return new ResResource(COHERE_NS . 'has_creation_date');
	}

	function HAS_DESCRIPTION()
	{
		return new ResResource(COHERE_NS . 'has_description');
	}

	function HAS_TO_NODE()
	{
		return new ResResource(COHERE_NS . 'has_to_node');
	}

	function HAS_NAME()
	{
		return new ResResource(COHERE_NS . 'has_name');
	}

}


?>